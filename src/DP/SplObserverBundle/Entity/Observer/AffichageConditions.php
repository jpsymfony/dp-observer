<?php

namespace DP\SplObserverBundle\Entity\Observer;

/**
 * AffichageConditions
 *
 */
class AffichageConditions implements \SplObserver
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

    public function __construct(\SplSubject $observable)
    {
        $observable->attach($this);
    }

    public function update(\SplSubject $observable)
    {
        if ($observable instanceof \DP\SplObserverBundle\Entity\Observable\DonneesMeteo) {
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