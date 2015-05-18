<?php

namespace DP\SfObserverBundle\Entity\Observable;

use Symfony\Component\EventDispatcher\EventDispatcher;
use DP\SfObserverBundle\Event\DonneesMeteoEvent;

/**
 * DonneesMeteo => celui qui est observé
 */
class DonneesMeteo
{
    private $temperature;
    private $humidity;
    private $pressure;
    private $dispatcher;

    function getTemperature()
    {
        return $this->temperature;
    }

    function getHumidity()
    {
        return $this->humidity;
    }

    function getPressure()
    {
        return $this->pressure;
    }

    function setDispatcher(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function setMesures($temperature, $humidity, $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity    = $humidity;
        $this->pressure    = $pressure;
        $event             = new DonneesMeteoEvent($this);

        $this->dispatcher->dispatch('donnees_meteo.update', $event);
//        $this->setChanged();
//        $this->notify();
    }

}