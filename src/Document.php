<?php

namespace P;

class Document extends \DOMDocument
{
	public static $DOCUMENT;
	private $nodes = [];


	public function __construct($version = '', $encoding = 'UTF-8')
	{
		parent::__construct($version, $encoding);
		$this->registerNodeClass("DOMDocument", Document::class);
		$this->registerNodeClass("DOMElement", HTMLElement::class);
		$this->registerNodeClass("DOMText", Text::class);
		$this->registerNodeClass("DOMNode", Node::class);
		$this->registerNodeClass("DOMAttr", Attr::class);
		$this->registerNodeClass("DOMDocumentFragment", DocumentFragment::class);
		$this->registerNodeClass("DOMComment", Comment::class);
		$this->formatOutput = false;
	}

	public function querySelectorAll(string $selector)
	{
		$converter = new \Symfony\Component\CssSelector\CssSelectorConverter();
		$expression = $converter->toXPath($selector);

		$xpath = new \DOMXPath($this);
		return $xpath->evaluate($expression);
	}

	public static function Current()
	{
		if (!self::$DOCUMENT) {
			self::$DOCUMENT = new Document();
		}
		return self::$DOCUMENT;
	}

	public function createElement($name, $value = null)
	{
		if ($class = self::ELEMENT_CLASS[$name]) {
			$this->registerNodeClass("DOMElement", $class);
		} else {
			$this->registerNodeClass("DOMElement", HTMLElement::class);
		}

		$element = parent::createElement($name, $value);
		$this->nodes[] = $element;
		return $element;
	}

	const ELEMENT_CLASS = [
		"a" => HTMLAnchorElement::class,
		"button" => HTMLButtonElement::class,
		"div" => HTMLDivElement::class,
		"form" => HTMLFormElement::class,
		"img" => HTMLImageElement::class,
		"span" => HTMLSpanElement::class,
		"input" => HTMLInputElement::class,
		"optgroup" => HTMLOptGroupElement::class,
		"option" => HTMLOptionElement::class,
		"select" => HTMLSelectElement::class,
		"span" => HTMLSpanElement::class,
		"td" => HTMLTableCellElement::class,
		"th" => HTMLTableCellElement::class,
		"table" => HTMLTableElement::class,
		"tr" => HTMLTableRowElement::class,
		"thead" => HTMLTableSectionElement::class,
		"tbody" => HTMLTableSectionElement::class,
		"tfoot" => HTMLTableSectionElement::class,
		"textarea" => HTMLTextAreaElement::class
	];

	public function importNode(\DOMNode $node, $deep = false)
	{
		if ($node instanceof \DOMElement) {
			$n = $this->createElement($node->tagName);

			foreach ($node->attributes as $attr) {
				$n->appendChild($n->ownerDocument->importNode($attr));
			}

			if ($deep) {
				foreach ($node->childNodes as $child) {
					$n->appendChild($this->importNode($child, true));
				}
			}
		} else {
			$n = parent::importNode($node, true);
		}

		return $n;
	}
}
