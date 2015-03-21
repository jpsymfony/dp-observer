<?php

namespace DP\SfObserverBundle\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use DP\SfObserverBundle\Event\DonneesMeteoEvent;

class AffichageConditionsSubscriber implements EventSubscriberInterface
{

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
        $this->getNewValues();
    }

    public function getNewValues()
    {
        return array('temperature' => $this->temperature, 'humidite' => $this->humidite, 'pression' => $this->pression);
    }

}