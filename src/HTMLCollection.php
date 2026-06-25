<?php

namespace P;

use ArrayObject;

/**
 * @template T of Element
 * @extends ArrayObject<int, T>
 * @property-read int $length Returns the number of items in the collection.
 */
class HTMLCollection extends ArrayObject
{
    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        switch ($name) {
            case "length":
                return $this->count();
        }
        return null;
    }

    public function item(int $index): ?Element
    {
        if (!$this->offsetExists($index)) {
            return null;
        }
        return $this[$index];
    }
}
