<?php

namespace P;

class Event
{
    public $type;
    public function __construct($type)
    {
        $this->type = $type;
    }
}