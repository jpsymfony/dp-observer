<?php

namespace DP\SplObserverBundle\Entity\Observer;

/**
 * AffichageConditions
 *
 */
class AffichageStats implements \SplObserver
{
    private $maxTemp = 0.0;
    private $minTemp = 200;
    private $sumTemp = 0.0;
    private $numReadings;

    public function __construct(\SplSubject $observable)
    {
        $observable->attach($this);
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

    
    public function update(\SplSubject $observable)
    {
        if ($observable instanceof \DP\SplObserverBundle\Entity\Observable\DonneesMeteo) {
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