<?php

namespace DP\SfObserverBundle\Listener;

use DP\SfObserverBundle\Event\DonneesMeteoEvent;

class AffichageStatsListener
{
    private $maxTemp;
    private $minTemp;
    private $sumTemp = 0.0;
    private $numReadings;

     public function setMaxTemp($maxTemp)
    {
        $this->maxTemp = $maxTemp;
    }

    public function getMaxTemp()
    {
        return $this->maxTemp;
    }

    public function setMinTemp($minTemp)
    {
        $this->minTemp = $minTemp;
    }

    public function getMinTemp()
    {
        return $this->minTemp;
    }

    public function getSumTemp()
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
    }

    public function getNewValues()
    {
        $temperature = ($this->sumTemp / $this->numReadings) . "/" . $this->maxTemp . "/" . $this->minTemp;

        return array("AvgMaxMinTemperature" => $temperature);
    }

}