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
		$this->registerNodeClass("DOMElement", Element::class);
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
			$this->registerNodeClass("DOMElement", Element::class);
		}

		$element = parent::createElement($name, $value);
		$this->nodes[] = $element;
		return $element;
	}

	const ELEMENT_CLASS = [
		"div" => HTMLDivElement::class,
		"span" => HTMLSpanElement::class,
		"input" => HTMLInputElement::class,
		"table" => HTMLTableElement::class,
		"thead" => HTMLTableSectionElement::class,
		"tbody" => HTMLTableSectionElement::class,
		"tfoot" => HTMLTableSectionElement::class,
		"tr" => HTMLTableRowElement::class,
		"textarea" => HTMLTextAreaElement::class,
		"form" => HTMLFormElement::class,
		"select" => HTMLSelectElement::class,
		"a" => HTMLAnchorElement::class,
		"option" => HTMLOptionElement::class,
		"button" => HTMLButtonElement::class,
		"td" => HTMLTableCellElement::class,
		"th" => HTMLTableCellElement::class,
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
