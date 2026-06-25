<?php

namespace P;

class DOMTokenList implements \ArrayAccess
{
    private Element $element;
    private string $attribute_name;

    public function __construct(Element $element, string $attribute_name)
    {
        $this->element = $element;
        $this->attribute_name = $attribute_name;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $values = array_merge($this->values(), [$value]);
            $this->value = implode(" ", $values);
        } else {
            $values = $this->values();
            $values[$offset] = $value;
            $this->value = implode(" ", $values);
        }
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->values()[$offset]);
    }

    public function offsetUnset(mixed $offset): void
    {
        $values = $this->values();
        unset($values[$offset]);
        $this->value = implode(" ", $values);
    }

    public function offsetGet(mixed $offset): mixed
    {
        $values = $this->values();
        return isset($values[$offset]) ? $values[$offset] : null;
    }

    /**
     * Returns an iterator, allowing you to go through all values of the key/value pairs contained in this object.
     *
     * @return array<int, string>
     */
    public function values(): array
    {
        $values = explode(" ", $this->element->getAttribute($this->attribute_name));

        return array_filter($values, function ($value) {
            return $value !== "";
        });
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($name == "length")
            return count($this->values());
        if ($name == "value") {
            return  $this->element->getAttribute($this->attribute_name);
        }
        return null;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value): void
    {
        if ($name == "value") {
            $this->element->setAttribute($this->attribute_name, $value);
        }
    }

    /**
     * Adds the specified tokens to the list.
     */
    public function add(string ...$values): void
    {
        foreach ($values as $value) {
            $this[] = $value;
        }
    }

    /**
     * Removes the specified tokens from the list.
     */
    public function remove(string ...$values): void
    {
        $values = array_diff($this->values(), $values);
        $this->value = implode(" ", $values);
    }

    /**
     * Returns true if the list contains the given token, otherwise false.
     */
    public function contains(string $token): bool
    {
        return in_array($token, $this->values());
    }

    /**
     * Removes the token from the list if it exists, or adds it to the list if it doesn't. Returns a boolean indicating whether the token is in the list after the operation.
     */
    public function toggle(string $token, ?bool $force = null): bool
    {
        if ($force === null) {
            $force = !$this->contains($token);
        }
        if ($force) {
            $this->add($token);
        } else {
            $this->remove($token);
        }
        return $force;
    }

    /**
     * Replaces the token with another one.
     */
    public function replace(string $oldToken, string $newToken): bool
    {
        if (!$this->contains($oldToken)) {
            return false;
        }
        $values = $this->values();
        $values = array_map(function ($value) use ($oldToken, $newToken) {
            return $value == $oldToken ? $newToken : $value;
        }, $values);
        $this->value = implode(" ", $values);
        return true;
    }

    /**
     * Executes a provided callback function once for each DOMTokenList element.
     */
    public function forEach(callable $callback, mixed $thisArg = null): void
    {
        foreach ($this->values() as $value) {
            $callback($value, $thisArg);
        }
    }
}
