<?php

namespace P;

use \DOMNode;


class Element extends \DOMElement
{
    public $data = [];



    public function __construct($name, $value = "", $uri = null)
    {
        parent::__construct($name, $value, $uri);
        Document::Current()->appendChild($this);
    }

    public function contains(DOMNode $otherNode)
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

    public function querySelectorAll(string $selector)
    {
        $converter = new \Symfony\Component\CssSelector\CssSelectorConverter();
        $expression = $converter->toXPath($selector);

        $xpath = new \DOMXPath($this->ownerDocument);
        return $xpath->evaluate($expression, $this);
    }

    public function matches(string $selectorString)
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

    public function prependChild(DOMNode $newnode)
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
            case "innerText":
                $this->textContent = $value;
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
                    $innerHTML .= $child->ownerDocument->saveHTML($child);
                }
                return $innerHTML;
            case "outerHTML":
                $doc = new Document();
                $doc->appendChild($doc->importNode($this, true));
                return substr($doc->saveHTML(), 0, -1);
                break;
            case 'innerText':
                return $this->textContent;
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
            case 'classList':
                if (!$this->hasAttribute("class")) {
                    $this->setAttribute("class", "");
                }
                return new DOMTokenList($this->attributes->getNamedItem("class"));
                break;
            case 'style':
                if (!$this->hasAttribute("style")) {
                    $this->setAttribute("style", "");
                }
                return new CSSStyleDeclaration($this->attributes->getNamedItem("style"));
                break;
        }
    }

    public function setAttribute($name, $value = null)
    {
        if ($value === true || func_num_args() == 1) {
            $this->removeAttribute($name);
            @$attr = new Attr($name);
            $this->appendChild($attr);
        } elseif ($value === false) {
            $this->removeAttribute($name);
        } else {
            parent::setAttribute($name, $value);
        }
    }
}
