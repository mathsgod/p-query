<?php

namespace P;

class Attr extends \DOMAttr
{
    public function __toString(): string
    {
        return $this->value;
    }
}
