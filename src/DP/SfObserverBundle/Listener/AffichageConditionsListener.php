<?php

namespace DP\SfObserverBundle\Listener;

use DP\SfObserverBundle\Event\DonneesMeteoEvent;

class AffichageConditionsListener
{
    private $temperature;
    private $humidite;
    private $pression;

    public function update(DonneesMeteoEvent $event)
    {
        $donneesMeteo = $event->getDonneesMeteo();
        $this->setTemperature($donneesMeteo->getTemperature());
        $this->setHumidite($donneesMeteo->getHumidity());
        $this->setPression($donneesMeteo->getPressure());
    }

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function getHumidite()
    {
        return $this->humidite;
    }

    public function getPression()
    {
        return $this->pression;
    }

    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    public function setHumidite($humidite)
    {
        $this->humidite = $humidite;
    }

    public function setPression($pression)
    {
        $this->pression = $pression;
    }

    public function getNewValues()
    {
        return array('temperature' => $this->temperature, 'humidite' => $this->humidite, 'pression' => $this->pression);
    }
}