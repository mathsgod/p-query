<?php

namespace P;

use ArrayObject;
class HTMLCollection extends ArrayObject
{
    public function __get($name)
    {
        if ($name == "length") {
            return $this->count();
        }
        return parent::__get($name);
    }
}