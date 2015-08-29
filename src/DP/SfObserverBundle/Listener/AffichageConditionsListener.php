<?php

namespace DP\SfObserverBundle\Listener;

use DP\SfObserverBundle\Event\DonneesMeteoEvent;

class AffichageConditionsListener
{
    private $temperature;
    private $humidity;
    private $pressure;

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function getHumidity()
    {
        return $this->humidity;
    }

    public function getPressure()
    {
        return $this->pression;
    }

    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    public function setHumidity($humidity)
    {
        $this->humidity = $humidity;
    }

    public function setPressure($pressure)
    {
        $this->pressure = $pressure;
    }

    public function update(DonneesMeteoEvent $event)
    {
        $donneesMeteo      = $event->getDonneesMeteo();
        $this->temperature = $donneesMeteo->getTemperature();
        $this->humidity    = $donneesMeteo->getHumidity();
        $this->pressure    = $donneesMeteo->getPressure();
    }

    public function getNewValues()
    {
        return array('temperature' => $this->temperature, 'humidite' => $this->humidity, 'pression' => $this->pressure);
    }
}