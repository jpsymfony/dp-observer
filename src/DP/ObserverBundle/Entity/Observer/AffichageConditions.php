<?php

namespace DP\ObserverBundle\Entity\Observer;

use DP\ObserverBundle\Interfaces\Observer;
use DP\ObserverBundle\AbstractClass\Observable;

/**
 * AffichageConditions
 *
 */
class AffichageConditions implements Observer
{
    private $temperature;
    private $humidity;
    private $pressure;

    function getTemperature()
    {
        return $this->temperature;
    }

    function getHumidite()
    {
        return $this->humidity;
    }

    function getPression()
    {
        return $this->pressure;
    }
    
    function setCurrentPressure($currentPressure)
    {
        $this->currentPressure = $currentPressure;
    }

    public function __construct(Observable $observable)
    {
        $observable->addObservers($this);
    }

    public function update(Observable $observable)
    {
        if ($observable instanceof \DP\ObserverBundle\Entity\Observable\DonneesMeteo) {
            $this->temperature = $observable->getTemperature();
            $this->humidity    = $observable->getHumidity();
            $this->pressure    = $observable->getPressure();
        }
    }

    public function getNewValues()
    {
        return array('temperature' => $this->temperature, 'humidite' => $this->humidity, 'pression' => $this->pressure);
    }

}