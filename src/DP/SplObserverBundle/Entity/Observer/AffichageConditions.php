<?php

namespace DP\SplObserverBundle\Entity\Observer;

/**
 * AffichageConditions
 *
 */
class AffichageConditions implements \SplObserver
{
    private $temperature;
    private $humidite;
    private $pression;

    function getTemperature()
    {
        return $this->temperature;
    }

    function getHumidite()
    {
        return $this->humidite;
    }

    function getPression()
    {
        return $this->pression;
    }

    public function __construct(\SplSubject $observable)
    {
        $observable->attach($this);
    }

    public function update(\SplSubject $observable)
    {
        if ($observable instanceof \DP\SplObserverBundle\Entity\Observable\DonneesMeteo) {
            $this->temperature = $observable->getTemperature();
            $this->humidite    = $observable->getHumidity();
            $this->pression    = $observable->getPressure();
            $this->getNewValues();
        }
    }

    public function getNewValues()
    {
        return array('temperature' => $this->temperature, 'humidite' => $this->humidite, 'pression' => $this->pression);
    }

}