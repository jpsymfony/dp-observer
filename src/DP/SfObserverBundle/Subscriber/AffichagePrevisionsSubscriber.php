<?php

namespace DP\SfObserverBundle\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use DP\SfObserverBundle\Event\DonneesMeteoEvent;

class AffichagePrevisionsSubscriber implements EventSubscriberInterface
{
    private $currentPressure;
    private $lastPressure;
    private $prevision;
    
    static public function getSubscribedEvents()
    {
        return array(
            'donnees_meteo.update' => array('update', 0),
        );
    }

    public function getCurrentPressure()
    {
        return $this->currentPressure;
    }

    public function setCurrentPressure($currentPressure)
    {
        $this->currentPressure = $currentPressure;
    }

    public function getLastPressure()
    {
        return $this->lastPressure;
    }

    public function getPrevision()
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