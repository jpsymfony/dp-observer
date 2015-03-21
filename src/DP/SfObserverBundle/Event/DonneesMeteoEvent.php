<?php

namespace DP\SfObserverBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use DP\SfObserverBundle\Entity\Observable\DonneesMeteo;

class DonneesMeteoEvent extends Event
{
    private $donneesMeteo;

    public function __construct(DonneesMeteo $donneesMeteo)
    {
        $this->donneesMeteo = $donneesMeteo;
    }

    public function getDonneesMeteo()
    {
        return $this->donneesMeteo;
    }

}