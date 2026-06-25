<?php

namespace P;

use DOMAttr;
use DOMNode;
use DOMDocument;
use DOMNodeList;

class Document extends DOMDocument
{

	const ELEMENT_CLASS = [
		"area" => HTMLAreaElement::class,
		"a" => HTMLAnchorElement::class,
		"audio" => HTMLAudioElement::class,
		"br" => HTMLBRElement::class,
		"p" => HTMLParagraphElement::class,
		"button" => HTMLButtonElement::class,
		"caption" => HTMLTableCaptionElement::class,
		"div" => HTMLDivElement::class,
		"datalist" => HTMLDataListElement::class,
		"form" => HTMLFormElement::class,
		"img" => HTMLImageElement::class,
		"span" => HTMLSpanElement::class,
		"input" => HTMLInputElement::class,
		"label" => HTMLLabelElement::class,
		"optgroup" => HTMLOptGroupElement::class,
		"option" => HTMLOptionElement::class,
		"select" => HTMLSelectElement::class,
		"td" => HTMLTableCellElement::class,
		"th" => HTMLTableCellElement::class,
		"table" => HTMLTableElement::class,
		"tr" => HTMLTableRowElement::class,
		"thead" => HTMLTableSectionElement::class,
		"tbody" => HTMLTableSectionElement::class,
		"tfoot" => HTMLTableSectionElement::class,
		"textarea" => HTMLTextAreaElement::class,
		"template" => HTMLTemplateElement::class,
		"progress" => HTMLProgressElement::class,
		"video" => HTMLVideoElement::class,

	];

	public static ?Document $DOCUMENT = null;
	private array $nodes = [];

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

	public function querySelectorAll(string $selector): DOMNodeList
	{
		$converter = new \Symfony\Component\CssSelector\CssSelectorConverter();
		$expression = $converter->toXPath($selector);

		$xpath = new \DOMXPath($this);
		return $xpath->query($expression, $this);
	}

	/**
	 * The Document method querySelector() returns the first Element within the document that matches the specified selector, or group of selectors. If no matches are found, null is returned.
	 */
	public function querySelector(string $selectors): ?Element
	{
		$converter = new \Symfony\Component\CssSelector\CssSelectorConverter();
		$expression = $converter->toXPath($selectors);

		$xpath = new \DOMXPath($this);
		$item = $xpath->query($expression, $this)->item(0);
		return $item instanceof Element ? $item : null;
	}

	public static function Current(): self
	{
		if (self::$DOCUMENT === null) {
			self::$DOCUMENT = new Document();
			self::$DOCUMENT->loadHTML("<div></div>");
		}
		return self::$DOCUMENT;
	}

	public function createElement(string $tagName, ?string $value = null): Element
	{
		if (isset(self::ELEMENT_CLASS[$tagName]) && $class = self::ELEMENT_CLASS[$tagName]) {
			$this->registerNodeClass("DOMElement", $class);
		} else {
			$this->registerNodeClass("DOMElement", HTMLElement::class);
		}

		$element = parent::createElement($tagName, $value ?? "");
		$this->nodes[] = $element;
		return $element;
	}

	public function importNode(DOMNode $node, bool $deep = false): DOMNode
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
	public array $_observer_regs = [];

	function _notifyNodeAdded(DOMNode $node): DOMNode
	{
		foreach ($this->_observer_regs as $reg) {

			$records = [];
			if ($reg->options["childList"]) {
				if ($node instanceof Element) {

					if (isset($reg->options["subtree"])) {
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

			if (isset($reg->options["attributes"])) {
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
