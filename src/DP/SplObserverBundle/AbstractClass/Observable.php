<?php

namespace DP\SplObserverBundle\AbstractClass;

use Doctrine\Common\Collections\ArrayCollection;

abstract class Observable implements \SplSubject
{
    /**
     *
     * @var arrayCollection
     */
    private $observers;
    private $changed;

    public function __construct()
    {
        $this->observers = new ArrayCollection();
        $this->changed     = false;
    }

    public function attach(\SplObserver $observer)
    {
        $this->observers->add($observer);
    }

    public function notify()
    {
        if ($this->hasChanged()) {
            foreach ($this->observers as $observer) {
                $observer->update($this);
            }
        }
        $this->clearChanged();
    }

    public function detach(\SplObserver $observer)
    {
        $this->observers->remove($observer);
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