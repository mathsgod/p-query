<?php

namespace P;


/**
 * @property-read int $length Is an integer representing the number of objects stored in the object.
 * @property string $value A stringifier property that returns the value of the list as a string.
 */
class DOMTokenList implements \ArrayAccess
{
	private $element;
	private $attribute_name;

	public function __construct(Element $element, string $attribute_name)
	{
		$this->element = $element;
		$this->attribute_name = $attribute_name;
	}

	public function offsetSet($offset, $value)
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

	public function offsetExists($offset)
	{
		return isset($this->values()[$offset]);
	}

	public function offsetUnset($offset)
	{
		$values = $this->values();
		unset($values[$offset]);
		$this->value = implode(" ", $values);
	}

	public function offsetGet($offset)
	{
		$values = $this->values();
		return isset($values[$offset]) ? $values[$offset] : null;
	}

	/**
	 * Returns an iterator, allowing you to go through all values of the key/value pairs contained in this object.
	 */
	function values()
	{
		$values = explode(" ", $this->element->getAttribute($this->attribute_name));

		return array_filter($values, function ($value) {
			return $value !== "";
		});
	}

	public function __get($name)
	{
		if ($name == "length")
			return count($this->values());
		if ($name == "value") {
			return  $this->element->getAttribute($this->attribute_name);
		}
	}

	public function __set($name, $value)
	{
		if ($name == "value") {
			$this->element->setAttribute($this->attribute_name, $value);
		}
	}

	/**
	 * Adds the specified tokens to the list.
	 */
	function add(...$values)
	{
		foreach ($values as $value) {
			$this[] = $value;
		}
	}

	/**
	 * Removes the specified tokens from the list.
	 */
	function remove(...$values)
	{
		$values = array_diff($this->values(), $values);
		$this->value = implode(" ", $values);
	}

	/**
	 * Returns true if the list contains the given token, otherwise false.
	 */
	function contains(string $token): bool
	{
		return in_array($token, $this->values());
	}

	/**
	 * Removes the token from the list if it exists, or adds it to the list if it doesn't. Returns a boolean indicating whether the token is in the list after the operation.
	 */
	function toggle(string $token, bool $force = null)
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
	function replace(string $oldToken, string $newToken)
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
	function forEach(callable $callback, $thisArg = null)
	{
		foreach ($this->values() as $value) {
			$callback($value, $thisArg);
		}
	}
}
