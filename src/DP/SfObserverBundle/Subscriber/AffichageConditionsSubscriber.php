<?php

namespace DP\SfObserverBundle\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use DP\SfObserverBundle\Event\DonneesMeteoEvent;

class AffichageConditionsSubscriber implements EventSubscriberInterface
{
    private $temperature;
    private $humidite;
    private $pression;

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function getHumidite()
    {
        return $this->humidite;
    }

    public function getPression()
    {
        return $this->pression;
    }

    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    public function setHumidite($humidite)
    {
        $this->humidite = $humidite;
    }

    public function setPression($pression)
    {
        $this->pression = $pression;
    }

    static public function getSubscribedEvents()
    {
        return array(
            'donnees_meteo.update' => array('update', 0),
        );
    }

    public function update(DonneesMeteoEvent $event)
    {
        $donneesMeteo      = $event->getDonneesMeteo();
        $this->temperature = $donneesMeteo->getTemperature();
        $this->humidite    = $donneesMeteo->getHumidity();
        $this->pression    = $donneesMeteo->getPressure();
    }

    public function getNewValues()
    {
        return array('temperature' => $this->temperature, 'humidite' => $this->humidite, 'pression' => $this->pression);
    }

}