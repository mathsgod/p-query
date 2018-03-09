<?php

namespace P;

class Document extends Node {
	public function __construct() {
		$this->nodeType = Node::DOCUMENT_NODE;
	}

	public static function createElement($tagName) {
		switch (strtolower($tagName)) {
			case "span":
				return new HTMLSpanElement();
				break;
			case "optgroup":
				return new HTMLOptGroupElement();
				break;
			case "thead":
			case "tfoot":
				return new HTMLTableSectionElement(strtolower($tagName));
				break;
			case "div":
				return new HTMLDivElement();
				break;
			case "input":
				return new HTMLInputElement();
				break;
			case "select":
				return new HTMLSelectElement();
				break;
			case "option":
				return new HTMLOptionElement();
				break;
			case "button":
				return new HTMLButtonElement();
				break;
			case "a":
				return new HTMLAnchorElement();
				break;
			case "table":
				return new HTMLTableElement();
				break;
			case "tr":
				return new HTMLTableRowElement();
				break;
			case "td":
				return new HTMLTableCellElement();
				break;
			default:
				return new HTMLElement(strtolower($tagName));
		}
	}

	public static function createTextNode($text) {
		return new Text($text);
	}
}

?>