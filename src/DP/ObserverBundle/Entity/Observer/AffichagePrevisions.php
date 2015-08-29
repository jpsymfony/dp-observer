<?php

namespace DP\ObserverBundle\Entity\Observer;

use DP\ObserverBundle\Interfaces\Observer;
use DP\ObserverBundle\AbstractClass\Observable;
use DP\ObserverBundle\Entity\Observable\DonneesMeteo;

/**
 * AffichageConditions
 *
 */
class AffichagePrevisions implements Observer
{
    private $currentPressure;
    private $lastPressure;
    private $prevision;
    
    function getCurrentPressure()
    {
        return $this->currentPressure;
    }

    function getLastPressure()
    {
        return $this->lastPressure;
    }
    
    function getPrevision()
    {
        return $this->prevision;
    }

    public function __construct(Observable $observable, $currentPressure)
    {
        $this->currentPressure = $currentPressure;
        $observable->addObservers($this);
    }

    public function update(Observable $observable)
    {
        if ($observable instanceof DonneesMeteo) {
            $this->lastPressure    = $this->currentPressure;
            $this->currentPressure = $observable->getPressure();
        }
    }

    public function getNewValues()
    {
        if ($this->currentPressure > $this->lastPressure) {
            $this->prevision = "Improving weather on the way!";
        } else if ($this->currentPressure == $this->lastPressure) {
            $this->prevision = "More of the same";
        } else if ($this->currentPressure < $this->lastPressure) {
            $this->prevision = "Watch out for cooler, rainy weather";
        }

        return array('prevision' => $this->prevision);
    }

}