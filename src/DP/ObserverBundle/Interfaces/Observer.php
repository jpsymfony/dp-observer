<?php

namespace DP\ObserverBundle\Interfaces;

use DP\ObserverBundle\AbstractClass\Observable;

interface Observer
{

    public function update(Observable $observable);
}