<?php

namespace P;

use DOMNode;

class Query extends \ArrayObject
{
    public static $match = [
        "ID" => "^#((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+)",
        "CLASS" => "^\\.((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+)",
        "TAG" => "^((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+|[*])",
        "ATTR" => "^\\[[\\x20\\t\\r\\n\\f]*((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+)(?:[\\x20\\t\\r\\n\\f]*([*^$|!~]?=)[\\x20\\t\\r\\n\\f]*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+))|)[\\x20\\t\\r\\n\\f]*\\]"
    ];

    public static function _($q)
    {
        return new Query($q);
    }

    public static function Parse($html)
    {
        $h = new \P\Query();
        $parser = new DOMParser($html);

        foreach ($parser->nodes as $node) {
            $node->parentNode = null;
            $h[] = $node;
        }

        return $h;
    }

    public static function ParseFile($file)
    {
        return self::Parse(file_get_contents($file));
    }

    public function __construct($tag = null)
    {
        if (is_object($tag)) {
            if ($tag instanceof DOMNode) {
                $this[] = $tag;
            } elseif ($tag instanceof Query) {
                foreach ($tag as $node) {
                    $this[] = $node;
                }
            } else {
                $parser = new DOMParser();
                $document = $parser->parseFromString((string)$tag);
                foreach ($document->childNodes as $node) {
                    $this[] = $node;
                }
            }
        } elseif ($tag) {
            if ($tag[0] == "<") {

                $parser = new DOMParser();
                $document = $parser->parseFromString($tag);

                foreach ($document->childNodes as $node) {
                    $this[] = $node;
                }
            } else {
                $document = new Document();
                $this[] = $document->createElement($tag);
            }
        }
    }

    public function size()
    {
        return count($this);
    }

    public function last()
    {
        $q = new Query();
        if (count($this)) {
            $q[] = $this[$this->size() - 1];
        }
        return $q;
    }

    public function first()
    {
        $q = new Query();
        if (count($this)) {
            $q[] = $this[0];
        }
        return $q;
    }

    public function html($html = null)
    {
        if (!func_num_args()) {
            $html = "";
            foreach ($this as $node) {
                foreach ($node->childNodes as $child) {
                    $html .= (string )$child;
                }
            }

            return $html;
        }

        foreach ($this as $i => $node) {
            $node->childNodes = [];
            if ($html instanceof \Closure) {
                $node->innerHTML = (string )$html($i);
            } else {
                $node->innerHTML = (string )$html;
            }
        }
        return $this;
    }

    public function prepend($node)
    {
        if (is_string($node)) {
            foreach ($this as $child) {
                $p = new DOMParser();
                $doc = $p->parseFromString($node);
                foreach ($doc->childNodes as $n) {
                    $child->prependChild($n);
                }
            }
            return $this;
        }

        if ($node instanceof DOMNode) {
            foreach ($this as $child) {
                $child->prependChild($child->ownerDocument->importNode($node, true));
            }
            return $this;
        }

        foreach ($this as $child) {
            foreach ($node as $n) {
                $child->prependChild($child->ownerDocument->importNode($n, true));
            }
        }
        return $this;
    }

    public function prependTo($target)
    {
        if ($target instanceof Element) {
            p($target)->prepend($this);
        } else {
            $target->prepend($this);
        }
        return $this;
    }

    public function appendTo($target)
    {
        if ($target instanceof Element) {
            p($target)->append($this);
        } else {
            $target->append($this);
        }

        return $this;
    }

    public function append($node)
    {
        if (is_string($node)) {
            foreach ($this as $child) {
                $p = new DOMParser();
                $doc = $p->parseFromString($node);
                foreach ($doc->childNodes as $n) {
                    $child->appendChild($child->owenrDocument->importNode($n, true));
                }
            }
            return $this;
        }
        if ($node instanceof DOMNode) {
            foreach ($this as $child) {


                $child->appendChild($child->ownerDocument->importNode($node, true));
            }
            return $this;
        }

        foreach ($this as $child) {
            foreach ($node as $n) {
                $child->appendChild($child->ownerDocument->importNode($n, true));
            }
        }
        return $this;
    }

    public function attr($name, $value = null)
    {
        if (func_num_args() == 1) {
            if (is_array($name) || is_object($name)) {
                foreach ($name as $k => $v) {
                    $this->attr($k, $v);
                }
                return $this;
            }
            return $this[0]->attributes[$name];
        }
        foreach ($this as $node) {
            $node->setAttribute($name, $value);
        }
        return $this;
    }

    public function after($content)
    {
        foreach ($this as $node) {
            $after = p($content);
            foreach ($after as $after_node) {
                if ($node->parentNode) {
                    $node->parentNode->insertBefore($node->ownerDocument->importNode($after_node, true), $node->nextSibling);
                }
            }
        }
    }

    public function before($content)
    {
        foreach ($this as $node) {
            $before = p($content);
            foreach ($before as $before_node) {
                $node->parentNode->insertBefore($node->ownerDocument->importNode($before_node, true), $node);
            }
        }
        return $this;
    }

    public function css($name, $value = null)
    {

        $name = str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
        $name[0] = strtolower($name[0]);
        if (func_num_args() == 1) {
            foreach ($this as $node) {
                return $node->style->$name;
            }
            return null;
        }

        foreach ($this as $node) {
            $node->style->$name = $value;
        }
        return $this;
    }

    public function closest($selector)
    {
        $q = new Query();
        foreach ($this as $node) {
            while ($node = $node->parentNode) {
                if ($node->matches($selector)) {
                    $q[] = $node;
                    break;
                }
            }
        }
        return $q;
    }

    public function data($key, $value = null)
    {
        if (func_num_args() == 1) {
            return $this[0]->data[$key];
        }

        foreach ($this as $node) {
            $node->data[$key] = $value;
        }
        return $this;
    }

    public function addClass($className)
    {
        $class = explode(" ", $className);

        foreach ($this as $node) {
            foreach ($class as $c) {
                if (!in_array($c, $node->classList->values())) {
                    $node->classList[] = $c;
                }
            }
        }
        return $this;
    }

    public function text($text)
    {
        foreach ($this as $node) {
            $node->innerText = $text;
        }
        return $this;
    }

    public function __toString()
    {
        $str = "";
        foreach ($this as $node) {
            $str .= (string )$node;
        }
        return $str;
    }

    public function contents()
    {
        $q = new Query();
        foreach ($this as $node) {
            foreach ($node->childNodes as $child) {
                $q[] = $child;
            }
        }
        return $q;
    }

    public function children()
    {
        $q = new Query();
        foreach ($this as $node) {
            foreach ($node->childNodes as $child) {
                if ($child instanceof Text) {
                    continue;
                }
                if ($child instanceof Comment) {
                    continue;
                }
                $q[] = $child;
            }
        }
        return $q;
    }


    public function __call($method, $args)
    {
        //for php5.6, empty is reserved word
        if ($method == "empty") {
            foreach ($this as $node) {
                while ($node->hasChildNodes()) {
                    $node->removeChild($node->firstChild);
                }
            }
            return $this;
        }

        if ($this->$method instanceof \Closure) {
            return call_user_func_array($this->$method, $args);
        }

        return parent::$method($args);
    }

    public function find($selector)
    {
        $q = new Query();

        $converter = new \Symfony\Component\CssSelector\CssSelectorConverter();
        $expression = $converter->toXPath($selector);

        foreach ($this as $node) {
            $xpath = new \DOMXPath($node->ownerDocument);

            foreach ($xpath->query($expression) as $node) {
                $q[] = $node;
            }
        }
        return $q;
    }

    public function remove($selector = null)
    {
        if (isset($selector)) {
            $this->find($selector)->remove();
        } else {
            foreach ($this as $node) {

                if ($parentNode = $node->parentNode) {
                    $parentNode->removeChild($node);
                }
            }
        }
    }

    public function removeAttr($attributeName)
    {
        foreach ($this as $node) {
            $node->removeAttribute($attributeName);
        }
        return $this;
    }

    public function removeClass($className)
    {
        if (func_num_args() == 0) {
            foreach ($this as $node) {
                foreach ($node->classList->values() as $c) {
                    $node->classList->remove($c);
                }
            }
            return $this;
        }

        $class = explode(" ", $className);
        foreach ($this as $node) {
            foreach ($class as $c) {
                $node->classList->remove($c);
            }
        }
        return $this;
    }

    public function replaceWith($newContent)
    {
        foreach ($this as $node) {
            foreach (p($newContent) as $n) {
                $node->parentNode->insertBefore($n, $node);
            }
            $node->parentNode->removeChild($node);
        }
    }

    public function required()
    {
        foreach ($this as $node) {
            $node->setAttribute("required", true);
        }
        return $this;
    }

    public function each($callback)
    {
        $i = 0;
        foreach ($this as $node) {
            $cl = $callback->bindTo($node);
            $cl($i, $node);
            $i++;
        }
        return $this;
    }

    public function val($value = null)
    {
        if (!func_num_args()) {
            $node = $this[0]; //first node
            if ($node->tagName == "select") {
                if ($node->hasAttribute("multiple")) {
                    $values = [];
                    foreach (p($node)->find("option[selected]") as $option) {
                        $values[] = $option->getAttribute("value");
                    }
                    return $values;
                }

                foreach (p($node)->find("option[selected]") as $option) {
                    if ($option->hasAttribute("selected")) {
                        return $option->getAttribute("value");
                    }
                }
            }
            return $node->getAttribute("value");
        }
        foreach ($this as $node) {
            if ($node->tagName == "input") {
                $node->setAttribute("value", $value);
            } elseif ($node->tagName == "select") {
                if (!is_array($value)) {
                    $value = [$value];
                }
                foreach (p($node)->find("option") as $option) {
                    if (in_array($option->getAttribute("value"), $value)) {
                        $option->setAttribute("selected", true);
                    } else {
                        $option->removeAttribute("selected");
                    }
                }
            } elseif ($node->tagName == "option") {
                $node->setAttribute("value", $value);
            }
        }
        return $this;
    }

    public function filter($selector)
    {
        $q = new Query();
        foreach ($this as $node) {
            if ($selector instanceof \Closure) {
                if ($selector($node)) {
                    $q[] = $node;
                }
            } elseif ($node->tagName == $selector) {
                $q[] = $node;
            }
        }
        return $q;
    }

    public function parent()
    {
        $q = new Query();
        foreach ($this as $node) {
            if ($parentNode = $node->parentNode) {
                $q[] = $parentNode;
            }
        }
        return $q;
    }

    public function wrap($wrappingElement)
    {
        foreach ($this as $node) {
            $we = p($wrappingElement)[0];
            $we = $node->ownerDocument->importNode($we, true);
            $parent = $node->parentNode;
            $parent->replaceChild($we, $node);
            $we->appendChild($node);
        }
        return $this;
    }

    public function wrapInner($wrappingElement)
    {
        foreach ($this as $node) {
            $we = p($wrappingElement)[0];
            $we = $node->ownerDocument->importNode($we, true);
            foreach ($node->childNodes as $n) {
                $we->appendChild($n);
            }
            $node->appendChild($we);
        }
        return $this;
    }

    public function toggleClass($className)
    {
        $classes = explode(" ", $className);
        foreach ($this as $node) {
            $n = p($node);
            foreach ($classes as $class) {
                if ($n->hasClass($class)) {
                    $n->removeClass($class);
                } else {
                    $n->addClass($class);
                }
            }
        }
        return $this;
    }

    public function hasClass($className)
    {
        foreach ($this as $node) {
            if (in_array($className, $node->classList->values())) {
                return true;
            }
        }
        return false;
    }

    public function prev()
    {
        $q = new Query();
        foreach ($this as $node) {
            $q[] = $node->previousSibling;
        }
        return $q;
    }

    public function next()
    {
        $q = new Query();
        foreach ($this as $node) {
            $q[] = $node->nextSibling;
        }
        return $q;
    }

    public function index()
    {
        $index = -1;
        $parent = $this->parent();
        if (!$parent->count()) {
            return $index;
        }


        foreach ($parent->children() as $i => $children) {
            if ($children === $this[0]) {
                $index = $i;
                break;
            }
        }
        return $index;
    }
}
