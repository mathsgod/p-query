<?php

namespace P;

use ArrayObject;

/**
 * 
 * @property int $length Returns the number of items in the collection.
 * 
 */
class HTMLCollection extends ArrayObject
{
    public function __get($name)
    {
        if ($name == "length") {
            return $this->count();
        }
    }
}
