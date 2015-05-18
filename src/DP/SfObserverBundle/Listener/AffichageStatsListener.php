<?php

namespace DP\SfObserverBundle\Listener;

use DP\SfObserverBundle\Event\DonneesMeteoEvent;

class AffichageStatsListener
{
    private $maxTemp;
    private $minTemp;
    private $sumTemp = 0.0;
    private $numReadings;

    public function __construct($minTemp, $maxTemp)
    {
        $this->minTemp = $minTemp;
        $this->maxTemp = $maxTemp;
//        $observable->attach($this);
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

    public function update(DonneesMeteoEvent $event)
    {
        $donneesMeteo = $event->getDonneesMeteo();
        $temp         = $donneesMeteo->getTemperature();
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

    public function getNewValues()
    {
        $temperature = ($this->sumTemp / $this->numReadings) . "/" . $this->maxTemp . "/" . $this->minTemp;

        return array("AvgMaxMinTemperature" => $temperature);
    }

}