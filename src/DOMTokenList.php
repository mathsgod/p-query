<?php

namespace P;

class DOMTokenList implements \ArrayAccess {

	protected $token = [];

	public function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->token[] = $value;
		} else {
			$this->token[$offset] = $value;
		}
	}

	public function offsetExists($offset) {
		return isset($this->token[$offset]);
	}

	public function offsetUnset($offset) {
		unset($this->token[$offset]);
	}

	public function offsetGet($offset) {
		return isset($this->token[$offset]) ? $this->token[$offset] : null;
	}

	public function values() {

		return $this->token;
	}

	public function __get($name) {
		if ($name == "length")
			return count($this->token);
	}

	public function add($class) {
		if (!in_array($class, $this->token)) {
			$this[] = $class;
		}
	}

	public function remove($class) {
		if (($key = array_search($class, $this->token)) !== false) {
			unset($this->token[$key]);
		}
	}

	public function contains() {
		return in_array($class, $this->token);
	}

	public function toggle($class) {
		if ($this->contains($class)) {
			$this->remove($class);
		} else {
			$this->add($class);
		}

	}


}
