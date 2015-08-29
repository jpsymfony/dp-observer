<?php

namespace DP\SfObserverBundle\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use DP\SfObserverBundle\Event\DonneesMeteoEvent;
use DP\SfObserverBundle\DPSfObserverEvents;

class AffichageConditionsSubscriber implements EventSubscriberInterface
{
    private $temperature;
    private $humidity;
    private $pressure;

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function getHumidity()
    {
        return $this->humidity;
    }

    public function getPressure()
    {
        return $this->pressure;
    }

    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    public function setHumidity($humidity)
    {
        $this->humidity = $humidity;
    }

    public function setPressure($pressure)
    {
        $this->pressure = $pressure;
    }

    static public function getSubscribedEvents()
    {
        return array(
            DPSfObserverEvents::MESURES_UPDATED => array('update', 0),
        );
    }

    public function update(DonneesMeteoEvent $event)
    {
        $donneesMeteo      = $event->getDonneesMeteo();
        $this->temperature = $donneesMeteo->getTemperature();
        $this->humidity    = $donneesMeteo->getHumidity();
        $this->pressure    = $donneesMeteo->getPressure();
    }

    public function getNewValues()
    {
        return array('temperature' => $this->temperature, 'humidite' => $this->humidity, 'pression' => $this->pressure);
    }

}