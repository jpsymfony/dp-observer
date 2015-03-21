<?php

namespace DP\SplObserverBundle\Entity\Observable;

use DP\SplObserverBundle\AbstractClass\Observable;

/**
 * DonneesMeteo => celui qui est observé
 */
class DonneesMeteo extends Observable
{
    /**
     * @var float
     *
     * @ORM\Column(name="temperature", type="float")
     */
    private $temperature;

    /**
     * @var float
     *
     * @ORM\Column(name="humidite", type="float")
     */
    private $humidity;

    /**
     * @var float
     *
     * @ORM\Column(name="pression", type="float")
     */
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