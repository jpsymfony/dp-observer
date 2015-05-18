<?php

namespace DP\SfObserverBundle\Listener;

use DP\SfObserverBundle\Event\DonneesMeteoEvent;

class AffichageConditionsListener
{

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