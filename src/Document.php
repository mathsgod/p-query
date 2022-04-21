<?php

namespace P;

use DOMAttr;
use DOMNode;
use DOMElement;
use DOMDocument;
use DOMNodeList;

class Document extends DOMDocument
{

	const ELEMENT_CLASS = [
		"a" => HTMLAnchorElement::class,
		"br" => HTMLBRElement::class,
		"p" => HTMLParagraphElement::class,
		"button" => HTMLButtonElement::class,
		"caption" => HTMLTableCaptionElement::class,
		"div" => HTMLDivElement::class,
		"form" => HTMLFormElement::class,
		"img" => HTMLImageElement::class,
		"span" => HTMLSpanElement::class,
		"input" => HTMLInputElement::class,
		"label" => HTMLLabelElement::class,
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
		"textarea" => HTMLTextAreaElement::class,
		"template" => HTMLTemplateElement::class
	];

	public static $DOCUMENT;
	private $nodes = [];

	public function __construct(string $version = '', string $encoding = 'UTF-8')
	{
		parent::__construct($version, $encoding);
		$this->registerNodeClass("DOMDocument", Document::class);
		$this->registerNodeClass("DOMNode", Node::class);
		$this->registerNodeClass("DOMElement", HTMLElement::class);
		$this->registerNodeClass("DOMText", Text::class);
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

	public static function Current(): self
	{
		if (!self::$DOCUMENT) {
			self::$DOCUMENT = new Document();
		}
		return self::$DOCUMENT;
	}

	public function createElement($tagName, $value = null): Element
	{
		if ($class = self::ELEMENT_CLASS[$tagName]) {
			$this->registerNodeClass("DOMElement", $class);
		} else {
			$this->registerNodeClass("DOMElement", HTMLElement::class);
		}

		$element = parent::createElement($tagName, $value ?? "");
		$this->nodes[] = $element;
		return $element;
	}

	public function importNode(DOMNode $node, $deep = false): DOMNode
	{

		if ($node instanceof \DOMElement) {
			$n = $this->createElement($node->tagName);

			foreach ($node->attributes as $attr) {
				$n->appendChild($this->importNode(clone $attr));
			}

			if ($deep) {
				foreach ($node->childNodes as $child) {
					$n->appendChild($this->importNode(clone $child, true));
				}
			}
		} else {
			$n = parent::importNode($node, true);
		}

		return $n;
	}


	/** @var MutationObserverRegistration[] */
	public $_observer_regs;

	function _notifyNodeAdded(DOMNode $node)
	{
		foreach ($this->_observer_regs as $reg) {

			$records = [];
			if ($reg->options["childList"]) {
				if ($node instanceof Element) {

					if ($reg->options["subtree"]) {
						if ($reg->element->contains($node)) {
							$record = new MutationRecord;
							$record->target = $reg->element;
							$record->type = "childList";
							$record->addedNodes[] = $node;
							$records[] = $record;
						}
					} else {
						if ($reg->element === $node->parentNode) {
							$record = new MutationRecord;
							$record->target = $reg->element;
							$record->type = "childList";
							$record->addedNodes[] = $node;
							$records[] = $record;
						}
					}
				}
			}

			if ($reg->options["attributes"]) {
				if ($reg->options["subtree"]) {
					if ($reg->element->contains($node)) {
						$record = new MutationRecord;
						$record->target = $reg->element;
						$record->type = "attributes";
						$records[] = $record;
					}
				} else {
					if ($node instanceof DOMAttr) {
						$record = new MutationRecord;
						$record->target = $reg->element;
						$record->type = "attributes";
						$records[] = $record;
					}
				}
			}

			if (count($records)) {
				call_user_func_array($reg->observer->callable, [$records, $reg->observer]);
			}
		}

		return $node;
	}
}
