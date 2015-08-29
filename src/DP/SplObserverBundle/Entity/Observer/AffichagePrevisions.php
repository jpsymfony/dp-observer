<?php

namespace DP\SplObserverBundle\Entity\Observer;

/**
 * AffichageConditions
 *
 */
class AffichagePrevisions implements \SplObserver
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
    
    public function __construct(\SplSubject $observable, $currentPressure)
    {
        $this->currentPressure = $currentPressure;
        $observable->attach($this);
    }

    public function update(\SplSubject $observable)
    {
        if ($observable instanceof \DP\SplObserverBundle\Entity\Observable\DonneesMeteo) {
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