<?php

namespace DP\ObserverBundle\Entity\Observer;

use DP\ObserverBundle\Interfaces\Observer;
use DP\ObserverBundle\AbstractClass\Observable;
use Doctrine\ORM\Mapping as ORM;

/**
 * AffichageConditions
 *
 */
class AffichageConditions implements Observer
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

    public function __construct(Observable $observable)
    {
        $observable->attach($this);
    }

    public function update(Observable $observable)
    {
        if ($observable instanceof \DP\ObserverBundle\Entity\Observable\DonneesMeteo) {
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