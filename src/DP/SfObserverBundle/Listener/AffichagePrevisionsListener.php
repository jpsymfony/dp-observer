<?php

namespace DP\SfObserverBundle\Listener;

use DP\SfObserverBundle\Event\DonneesMeteoEvent;

class AffichagePrevisionsListener
{
    private $currentPressure;
    private $lastPressure;
    private $prevision;

    function getCurrentPressure()
    {
        return $this->currentPressure;
    }

    public function setCurrentPressure($currentPressure)
    {
        $this->currentPressure = $currentPressure;
    }

    function getLastPressure()
    {
        return $this->lastPressure;
    }

    function getPrevision()
    {
        return $this->prevision;
    }

    public function update(DonneesMeteoEvent $event)
    {
        $donneesMeteo          = $event->getDonneesMeteo();
        $this->lastPressure    = $this->currentPressure;
        $this->currentPressure = $donneesMeteo->getPressure();
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

        return array('prevision' =>$this->prevision);
    }

}