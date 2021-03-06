<?php

namespace P;

use DOMNode;
use DOMElement;
use DOMNodeList;

/**
 * @property CSSStyleDeclaration $style
 */
class Element extends \DOMElement
{
    public $classList = null;
    public $data = [];
    public $_events = [];

    public function __construct(string $name, string $value = "", string $uri = null)
    {
        parent::__construct($name, $value, $uri);
        $this->classList = new DOMTokenList($this, "class");
        Document::Current()->appendChild($this);
    }

    public function addEventListener(string $type, callable $listener)
    {
        $this->_events[$type][] = $listener;
    }

    public function removeEventListener(string $type, callable $listener)
    {
        $events = [];
        foreach ($this->_events[$type] as $event) {
            if ($event !== $listener) {
                $events[] = $event;
            }
        }
        $this->_events[$type] = $events;
    }

    public function dispatchEvent(Event $event)
    {
        foreach ($this->_events[$event->type] as $c) {
            $c($event);
        }
    }

    public function contains(DOMNode $otherNode): bool
    {
        if ($this == $otherNode) {
            return true;
        }
        foreach ($this->childNodes as $node) {
            if ($node->contains($otherNode)) {
                return true;
            }
        }
        return false;
    }

    public function __toString()
    {
        return $this->outerHTML;
    }

    public function append($nodes)
    {
        if ($nodes instanceof DOMNode) {
            $this->appendChild($nodes);
        } else {
            $this->appendChild(new Text($nodes));
        }
    }

    public function prepend($nodes)
    {
        if ($nodes instanceof DOMNode) {
            $this->prependChild($nodes);
        } else {
            $this->prependChild(new Text($nodes));
        }
    }

    public function before($nodes)
    {
        if (!$this->parentNode) return;
        if ($nodes instanceof DOMNode) {
            $this->parentNode->insertBefore($nodes, $this);
        } else {
            $this->parentNode->insertBefore(new Text($nodes), $this);
        }
    }

    public function after($nodes)
    {
        if (!$this->parentNode) return;
        if ($nodes instanceof DOMNode) {
            $this->parentNode->insertBefore($nodes, $this->nextSibling);
        } else {
            $this->parentNode->insertBefore(new Text($nodes), $this->nextSibling);
        }
    }


    public function replaceWith($nodes)
    {
        if (!$this->parentNode) return;
        if (!$nodes instanceof DOMNode) {
            $nodes = new Text($nodes);
        }
        $this->parentNode->replaceChild($nodes, $this);
    }

    public function querySelector(string $selector)
    {
        $nodelist = $this->querySelectorAll($selector);
        if ($nodelist->length) {
            return $nodelist->item(0);
        }
        return null;
    }

    public function querySelectorAll(string $selector): DOMNodeList
    {
        $converter = new \Symfony\Component\CssSelector\CssSelectorConverter();
        $expression = $converter->toXPath($selector);

        $xpath = new \DOMXPath($this->ownerDocument);
        return $xpath->evaluate($expression, $this);
    }

    public function matches(string $selectorString): bool
    {
        $doc = new Document();
        $doc->appendChild($doc->importNode($this));
        $matches = $doc->querySelectorAll($selectorString);
        return  $matches->length == 1;
    }

    public function remove()
    {
        if ($this->parentNode) {
            $this->parentNode->removeChild($this);
        }
    }

    public function prependChild(DOMNode $newnode): DOMNode
    {
        $firstChild = $this->firstChild;
        return $this->insertBefore($newnode, $firstChild);
    }


    public function __set($name, $value)
    {
        switch ($name) {
            case "innerHTML":
                while ($this->hasChildNodes()) {
                    $this->removeChild($this->firstChild);
                }

                $p = new DOMParser();
                foreach ($p->parseFromString($value) as $n) {
                    parent::appendChild($this->ownerDocument->importNode($n, true));
                }
                return;
                break;
        }


        $this->$name = $value;
    }

    public function __get($name)
    {
        switch ($name) {
            case "innerHTML":
                $innerHTML = '';
                foreach ($this->childNodes as $child) {
                    if ($child instanceof DOMElement) {
                        $innerHTML .= $child->outerHTML;
                    } else {
                        $innerHTML .= $child->ownerDocument->saveHTML($child);
                    }
                }
                return $innerHTML;
            case "outerHTML":
                return $this->ownerDocument->saveHTML($this);
                break;
            case 'children':
                $collection = new HTMLCollection();
                foreach ($this->childNodes as $child) {
                    if ($child instanceof \DOMElement) {
                        $collection[] = $child;
                    }
                }
                return $collection;
                break;
            case 'style':
                if (!$this->hasAttribute("style")) {
                    $this->setAttribute("style", "");
                }
                return new CSSStyleDeclaration($this->attributes->getNamedItem("style"));
                break;
        }
    }

    public function setAttribute($name, $value)
    {
        if ($value === true || $value === "" || $value === null) {
            $this->removeAttribute($name);
            $this->appendChild($this->ownerDocument->createAttribute($name));
        } elseif ($value === false) {
            $this->removeAttribute($name);
        } else {
            parent::setAttribute($name, $value);
        }
    }

    public function closest(string $selector)
    {
        $el = $this;
        do {
            if ($el->matches($selector)) return $el;
            $el = $el->parentNode;
            if ($el instanceof Document) return null;
        } while ($el !== null);
        return null;
    }
}
