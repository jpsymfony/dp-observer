<?php

namespace DP\SplObserverBundle\Entity\Observable;

use DP\SplObserverBundle\AbstractClass\Observable;

/**
 * DonneesMeteo => celui qui est observé
 */
class DonneesMeteo extends Observable
{
    private $temperature;
    private $humidity;
    private $pressure;

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

    public function setMesures($temperature, $humidity, $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity    = $humidity;
        $this->pressure    = $pressure;
        $this->setChanged();
        $this->notify();
    }

}