<?php

namespace DP\ObserverBundle\Entity\Observer;

use DP\ObserverBundle\Interfaces\Observer;
use DP\ObserverBundle\AbstractClass\Observable;

/**
 * AffichageConditions
 *
 */
class AffichageStats implements Observer
{
    private $maxTemp;
    private $minTemp;
    private $sumTemp = 0.0;
    private $numReadings;

    public function __construct(Observable $observable, $minTemp, $maxTemp)
    {
        $this->minTemp = $minTemp;
        $this->maxTemp = $maxTemp;
        $observable->addObservers($this);
    }

    function getMaxTemp()
    {
        return $this->maxTemp;
    }

    function getMinTemp()
    {
        return $this->minTemp;
    }

    function getSumTemp()
    {
        return $this->sumTemp;
    }
    
    public function update(Observable $observable)
    {
        if ($observable instanceof \DP\ObserverBundle\Entity\Observable\DonneesMeteo) {
            $temp = $observable->getTemperature();
            $this->sumTemp += $temp;
            $this->numReadings++;

            if ($temp > $this->maxTemp) {
                $this->maxTemp = $temp;
            }

            if ($temp < $this->minTemp) {
                $this->minTemp = $temp;
            }

            $this->getNewValues();
        }
    }

    public function getNewValues()
    {
        $temperature = ($this->sumTemp / $this->numReadings) . "/" . $this->maxTemp . "/" . $this->minTemp;
        
        return array("AvgMaxMinTemperature" => $temperature);
    }

}