<?php

namespace DP\SfObserverBundle\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use DP\SfObserverBundle\Event\DonneesMeteoEvent;

class AffichageStatsSubscriber implements EventSubscriberInterface
{
    private $maxTemp;
    private $minTemp;
    private $sumTemp = 0.0;
    private $numReadings;
    
    static public function getSubscribedEvents()
    {
        return array(
            'donnees_meteo.update' => array('update', 0),
        );
    }

    public function __construct($minTemp, $maxTemp)
    {
        $this->minTemp = $minTemp;
        $this->maxTemp = $maxTemp;
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