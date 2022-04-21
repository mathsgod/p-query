<?php

namespace P;

use IteratorAggregate;
use Traversable;

/**
 * @property-read int $size
 */
class Set implements IteratorAggregate
{
    private $items = [];
    function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->items);
    }

    function add($item)
    {
        if (!in_array($item, $this->items)) {
            $this->items[] = $item;
        }
    }

    function has($item)
    {
        return in_array($item, $this->items);
    }

    function delete($item)
    {
        $index = array_search($item, $this->items);
        if ($index !== false) {
            unset($this->items[$index]);
        }
    }

    function clear()
    {
        $this->items = [];
    }

    function values()
    {
        return $this->getIterator();
    }

    function forEach(callable $callback, $thisArg = null)
    {
        foreach ($this->items as $key => $value) {

            Reflect::apply($callback, $thisArg, [$value, $key, $this]);
        }
    }

    function __get($name)
    {
        if ($name === 'size') {
            return count($this->items);
        }
    }
}
