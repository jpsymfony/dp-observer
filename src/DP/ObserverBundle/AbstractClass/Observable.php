<?php

namespace DP\ObserverBundle\AbstractClass;

use DP\ObserverBundle\Interfaces\Observer;
use Doctrine\Common\Collections\ArrayCollection;

abstract class Observable
{
    /**
     *
     * @var arrayCollection
     */
    private $observables;

    public function __construct()
    {
        $this->observables = new ArrayCollection();
    }

    public function attach(Observer $observer)
    {
        $this->observables->add($observer);
    }

    public function notify()
    {
        foreach ($this->observables as $observer) {
            $observer->update($this);
        }
    }

    public function detach(Observer $observer)
    {
        $this->observables->remove($observer);
    }

}