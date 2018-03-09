<?php

namespace P;
class HTMLTableElement extends HTMLElement {
	public function __construct() {
		parent::__construct("table");
	}

	public function insertRow($index = -1) {
		$row = new HTMLTableRowElement();
		$this->appendChild($row);

		return $row;
	}

	public function __get($name) {
		switch ($name) {
			case "tHead":
				foreach ($this->childNodes as $child) {
					if ($child->tagName == "thead") {
						return $child;
					}
				}
				break;
			case "tFoot":
				foreach ($this->childNodes as $child) {
					if ($child->tagName == "tfoot") {
						return $child;
					}
				}
				break;
		}

	}
}
