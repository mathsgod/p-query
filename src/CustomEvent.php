<?php

namespace P;

class CustomEvent extends Event
{

    public function __construct(string $typeArg, array $customEventInit = ["detail" => null])
    {
        parent::__construct($typeArg);
        foreach ($customEventInit as $k => $v) {
            $this->$k = $v;
        }
    }
}
