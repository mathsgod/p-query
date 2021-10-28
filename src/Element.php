<?php

namespace P;

use DOMNode;
use DOMElement;
use DOMNodeList;

/**
 * @property CSSStyleDeclaration $style
 * @property string $innerHTML The Element property innerHTML gets or sets the HTML markup contained within the element.
 * @property string $outerHTML Is a string representing the markup of the element including its content. When used as a setter, replaces the element with nodes parsed from the given string.
 * @property HTMLCollection<Element> $children
 * @property-read DOMTokenList $classList
 * @property string $id Is a string representing the id of the element.
 * @property string $className Is a string representing the class of the element.
 * @property-read Element|null $firstElementChild Returns the first child element of this element.
 * @property-read Element|null $lastElementChild Returns the last child element of this element.
 */
class Element extends DOMElement
{
    public $_events = [];
    public $__data = [];

    function __construct(string $name, string $value = "", string $uri = null)
    {
        parent::__construct($name, $value, $uri);
        Document::Current()->appendChild($this);
    }

    function toggleAttribute(string $name)
    {
        if ($this->hasAttribute($name)) {
            $this->removeAttribute($name);
            return false;
        } else {
            $this->setAttribute($name, true);
            return true;
        }
    }

    function addEventListener(string $type, callable $listener)
    {
        $this->_events[$type][] = $listener;
    }

    function removeEventListener(string $type, callable $listener)
    {
        $events = [];
        foreach ($this->_events[$type] as $event) {
            if ($event !== $listener) {
                $events[] = $event;
            }
        }
        $this->_events[$type] = $events;
    }

    function dispatchEvent(Event $event)
    {
        foreach ($this->_events[$event->type] as $c) {
            $c($event);
        }
    }

    function contains(DOMNode $otherNode): bool
    {
        if ($this === $otherNode) {
            return true;
        }
        foreach ($this->childNodes as $node) {
            if ($node->contains($otherNode)) {
                return true;
            }
        }
        return false;
    }

    function __toString()
    {
        return $this->outerHTML;
    }


    function querySelector(string $selector)
    {
        $nodelist = $this->querySelectorAll($selector);
        if ($nodelist->length) {
            return $nodelist->item(0);
        }
        return null;
    }

    function querySelectorAll(string $selector): DOMNodeList
    {
        $converter = new \Symfony\Component\CssSelector\CssSelectorConverter();
        $expression = $converter->toXPath($selector);

        $xpath = new \DOMXPath($this->ownerDocument);
        return $xpath->evaluate($expression, $this);
    }

    function matches(string $selectorString): bool
    {
        $doc = new Document();
        $doc->appendChild($doc->importNode($this));
        $matches = $doc->querySelectorAll($selectorString);
        return  $matches->length == 1;
    }


    function prependChild(DOMNode $newnode): DOMNode
    {
        $firstChild = $this->firstChild;
        return $this->insertBefore($newnode, $firstChild);
    }


    function __set($name, $value)
    {
        switch ($name) {
            case "id":
                $this->setAttribute("id", $value);
                break;
            case "className":
                $this->setAttribute("class", $value);
                break;
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

    function __get($name)
    {
        switch ($name) {
            case "id":
                return $this->getAttribute("id");
            case "className":
                return $this->getAttribute("class");
            case "classList":
                return new DOMTokenList($this, "class");
                break;
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
            case "lastElementChild":
                return $this->lastElementChild;
            case "firstElementChild":
                return $this->firstChild;
        }
    }

    function setAttribute($name, $value)
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

    function closest(string $selector)
    {
        $el = $this;
        do {
            if ($el->matches($selector)) return $el;
            $el = $el->parentNode;
            if ($el instanceof Document) return null;
        } while ($el !== null);
        return null;
    }

    function appendChild(DOMNode $node)
    {
        return Document::Current()->_notifyNodeAdded(parent::appendChild($node));
    }



    function registerMutationObserver(MutationObserver $observer, $options)
    {
        $document = Document::Current();
        $document->_observer_regs[] = new MutationObserverRegistration($observer, $this, $options);
    }
}
