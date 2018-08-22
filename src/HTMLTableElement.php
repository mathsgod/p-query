<?php

namespace P;

class HTMLTableElement extends HTMLElement
{
	public function __construct()
	{
		parent::__construct("table");
	}

	public function insertRow($index = -1)
	{
		if ($this->tBodies->length == 0) {
			$tbody = $this->createTBody();
		} else {
			$tbody = $this->tBodies[$this->tBodies->length - 1];
		}
		return $tbody->insertRow($index);
	}

	public function deleteTHead()
	{
		if ($thead = $this->tHead) {
			$thead->remove();
		}
	}

	public function deleteCaption()
	{
		if ($caption = $this->caption) {
			$caption->remove();
		}
	}

	public function deleteTFoot()
	{
		if ($tfoot = $this->tfoot) {
			$tfoot->remove();
		}
	}

	public function createCaption()
	{
		if ($this->caption) {
			return $this->caption;
		}
		$caption = new HTMLTableCaptionElement();
		$this->prepend($caption);
		return $caption;
	}

	public function createTBody()
	{
		$tbody = new HTMLTableSectionElement('tbody');

		if ($this->tBodies->length == 0) {
			$this->append($tbody);
		} else {
			//find last body
			$this->tBodies[$this->tBodies->length - 1]->after($tbody);
		}

		return $tbody;
	}

	public function createTHead()
	{
		if ($this->tHead) {
			return $this->tHead;
		}
		$thead = new HTMLTableSectionElement('thead');
		$this->prepend($thead);
		return $thead;
	}

	public function createTFoot()
	{
		if ($this->tFoot) {
			return $this->tFoot;
		}
		$tfoot = new HTMLTableSectionElement('tfoot');
		$this->append($tfoot);
		return $tfoot;
	}

	public function __get($name)
	{
		switch ($name) {
			case "caption":
				foreach ($this->children as $child) {
					if ($child instanceof HTMLTableCaptionElement) {
						return $child;
					}
				}
				break;
			case "tBodies":
				$collection = new HTMLCollection();
				foreach ($this->children as $child) {
					if ($child->tagName == "tbody") {
						$collection[] = $child;
					}
				}
				return $collection;

				break;
			case "tHead":
				foreach ($this->children as $child) {
					if ($child->tagName == "thead") {
						return $child;
					}
				}
				break;
			case "tFoot":
				foreach ($this->children as $child) {
					if ($child->tagName == "tfoot") {
						return $child;
					}
				}
				break;
		}
		return parent::__get($name);
	}

	public function __set($name, $value)
	{
		switch ($name) {
			case "tHead":
				if (!$value instanceof HTMLTableSectionElement) {
					throw new TypeError("The provided value is not of type 'HTMLTableSectionElement'.");
				}

				if ($value && $value->tagName != "thead") {
					throw new DOMException("Not a thead element.");
				}

				$this->deleteTHead();

				if (!$value)
					return;

				for ($child = $this->firstChildElement; $child; $child = $child->nextElementSibling) {
					if (!$child->tagName != "caption" && !$child->tagName != "colgroup") {
						break;
					}
				}
				$this->insertBefore($value, $child);
				return;
			case "tFoot":
				if (!$value instanceof HTMLTableSectionElement) {
					throw new TypeError("The provided value is not of type 'HTMLTableSectionElement'.");
				}

				if ($value && $value->tagName != "tfoot") {
					throw new DOMException("Not a tfoot element.");
				}

				$this->deleteTFoot();
				if ($value)
					$this->appendChild($value);

				return;
		}

		parent::__set($name, $value);
	}
}
