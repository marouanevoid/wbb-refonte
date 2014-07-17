<?php

namespace WBB\BarBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class TipEvent extends Event
{

    private $tip;

    public function __construct($tip)
    {
        $this->tip = $tip;
    }

    public function getTip()
    {
        return $this->tip;
    }

}
