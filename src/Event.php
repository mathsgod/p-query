<?php

namespace P;

class Event
{
    public string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }
}
