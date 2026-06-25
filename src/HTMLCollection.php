<?php

namespace P;

use ArrayObject;

/**
 * @property-read int $length Returns the number of items in the collection.
 
 */
class HTMLCollection extends ArrayObject
{
    public function __get($name)
    {
        switch ($name) {
            case "length":
                return $this->count();
        }
    }

    function item($index)
    {
        if (!$this->offsetExists($index)) {
            return null;
        }
        return $this[$index];
    }
}
