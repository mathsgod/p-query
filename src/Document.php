<?php

namespace P;

class Document extends \DOMDocument
{
	public static $DOCUMENT;

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
}
