<?php

namespace DP\SplObserverBundle\AbstractClass;

use Doctrine\Common\Collections\ArrayCollection;

abstract class Observable implements \SplSubject
{
    /**
     *
     * @var arrayCollection
     */
    private $observables;
    private $changed;

    public function __construct()
    {
        $this->observables = new ArrayCollection();
        $this->changed     = false;
    }

    public function attach(\SplObserver $observer)
    {
        $this->observables->add($observer);
    }

    public function notify()
    {
        if ($this->hasChanged()) {
            foreach ($this->observables as $observer) {
                $observer->update($this);
            }
        }
        $this->clearChanged();
    }

    public function detach(\SplObserver $observer)
    {
        $this->observables->remove($observer);
    }

    public function hasChanged()
    {
        return $this->changed;
    }

    public function setChanged()
    {
        $this->changed = true;
    }

    public function clearChanged()
    {
        $this->changed = false;
    }

}