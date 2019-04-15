<?php

namespace P;

use DOMNode;

class DOMTokenList implements \ArrayAccess
{

	private $node;
	public function __construct(DOMNode $node)
	{
		$this->node = $node;
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

	public function values()
	{
		if ($this->node->nodeValue) {
			return explode(" ", $this->node->nodeValue);
		} else {
			return [];
		}
	}

	public function __get($name)
	{
		if ($name == "length")
			return count($this->values());
		if ($name == "value") {
			return $this->node->nodeValue;
		}
	}

	public function __set($name, $value)
	{
		if ($name == "value") {
			$this->node->nodeValue = $value;
		}
	}

	public function add(...$values)
	{
		foreach ($values as $value) {
			$this[] = $value;
		}
	}

	public function remove(...$values)
	{
		$values = array_diff($this->values(), $values);
		$this->value = implode(" ", $values);
	}

	public function contains(string $token): bool
	{
		return in_array($token, $this->values());
	}

	public function toggle(string $token)
	{
		if ($this->contains($token)) {
			$this->remove($token);
			return false;
		} else {
			$this->add($token);
			return true;
		}
	}
}
