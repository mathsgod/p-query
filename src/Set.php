<?php

namespace P;

use IteratorAggregate;
use Traversable;

/**
 * @property-read int $size
 */
class Set implements IteratorAggregate
{
    /** @var array<int, mixed> */
    private array $items = [];

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->items);
    }

    public function add(mixed $item): void
    {
        if (!in_array($item, $this->items)) {
            $this->items[] = $item;
        }
    }

    public function has(mixed $item): bool
    {
        return in_array($item, $this->items);
    }

    public function delete(mixed $item): void
    {
        $index = array_search($item, $this->items);
        if ($index !== false) {
            unset($this->items[$index]);
        }
    }

    public function clear(): void
    {
        $this->items = [];
    }

    public function values(): Traversable
    {
        return $this->getIterator();
    }

    public function forEach(callable $callback, mixed $thisArg = null): void
    {
        foreach ($this->items as $key => $value) {
            Reflect::apply($callback, $thisArg, [$value, $key, $this]);
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($name === 'size') {
            return count($this->items);
        }
        return null;
    }
}
