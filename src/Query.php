<?php

namespace P;

class Query extends \ArrayObject
{
    public static $match=[
        "ID"=>"^#((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+)",
        "CLASS"=>"^\\.((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+)",
        "TAG"=>"^((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+|[*])",
        "ATTR"=>"^\\[[\\x20\\t\\r\\n\\f]*((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+)(?:[\\x20\\t\\r\\n\\f]*([*^$|!~]?=)[\\x20\\t\\r\\n\\f]*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+))|)[\\x20\\t\\r\\n\\f]*\\]"
    ];

    public static function _($q)
    {
        return new Query($q);
    }

    public static function Parse($html)
    {
        $h = new \P\Query();
        $e = new \P\Element();
        $e->innerHTML = $html;
        foreach ($e->childNodes as $node) {
            $node->parentNode = null;
            $h[] = $node;
        }

        return $h;
    }

    public static function ParseFile($file)
    {
        return self::Parse(file_get_contents($file));
    }

    public function __construct($tag)
    {
        if (is_object($tag)) {
            if ($tag instanceof Node) {
                $this[] = $tag;
            } elseif ($tag instanceof Query) {
                foreach ($tag as $node) {
                    $this[] = $node;
                }
            } else {
                $e = new Element();
                $e->innerHTML = (string )$tag;

                foreach ($e->childNodes as $node) {
                    $this[] = $node;
                }
            }
        } elseif ($tag) {
            if ($tag[0] == "<") {

                $parser=new DOMParser($tag);
                foreach ($parser->nodes as $node) {
                    $this[] = $node;
                }
            } else {
                $this[] = Document::createElement($tag);
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

    public function html($html)
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
                $e = new Element();
                $e->innerHTML = $node;
                foreach ($e->childNodes as $n) {
                    $child->prependChild($n);
                }
            }
            return $this;
        }

        $nodes = $node;
        if ($nodes instanceof \P\Node) {
            foreach ($this as $child) {
                $child->prependChild($nodes);
            }
            return $this;
        }

        foreach ($this as $child) {
            foreach ($nodes as $n) {
                $child->prependChild($n);
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
                $e = new Element();
                $e->innerHTML = $node;
                foreach ($e->childNodes as $n) {
                    $child->appendChild($n);
                }
            }
            return $this;
        } else {
            $nodes = $node;
        }

        if ($nodes instanceof \P\Node) {
            foreach ($this as $child) {
                $child->appendChild($nodes);
            }
            return $this;
        }

        foreach ($this as $child) {
            foreach ($nodes as $n) {
                $child->appendChild($n);
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
                    $node->parentNode->insertBefore($after_node, $node->nextSibling);
                }
            }
        }
    }

    public function before($content)
    {
        foreach ($this as $node) {
            $before = p($content);
            foreach ($before as $before_node) {
                $node->parentNode->insertBefore($before_node, $node);
            }
        }
        return $this;
    }

    public function css($name, $value = null)
    {
        foreach ($this as $node) {
            if ($value==="") {
                unset($node->style[$name]);
            } else {
                $node->style[$name] = $value;
            }
        }
        return $this;
    }

    public function closest($selector)
    {
        $q = new Query();
        foreach ($this as $node) {
            while ($node = p($node)->parent()) {
                if ($node->count() == 0) {
                    break;
                }

                if ($selector[0] == ".") {
                    if ($node->hasClass(substr($selector, 1))) {
                        $q[] = $node[0];
                        break;
                    }
                } else {
                    if ($node[0]->tagName == $selector) {
                        $q[] = $node[0];
                        break;
                    }
                }
            }
        }
        return $q;
    }

    public function data($key, $value)
    {
        if (func_num_args() == 1) {
            return $this[0]->dataset->$key;
        }

        foreach ($this as $node) {
            $node->dataset->$key = $value;
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
        if($method=="empty"){
            foreach ($this as $node) {
                $node->childNodes = [];
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
        $selectors = explode(" ", $selector);

        $q = new Query();
        $q->selector = $selector;

        if (sizeof($selectors) == 1) {
            $selector = $selectors[0];
            $firstChild = false;
            if ($selector[0] == ">") {
                $firstChild = true;
                $selector = substr($selector, 1);
            }

            foreach (explode(",", $selector) as $ss) {
                $s=$ss;
                //search tag
                $matches=[];
                if (preg_match("/".self::$match["TAG"]."/", $s, $matches)) {
                    $tagName=$matches[0];
                    $s=substr($s, strlen($tagName));
                }

                $matches=[];
                if (preg_match("/".self::$match["CLASS"]."/", $s, $matches)) {
                    $className=substr($matches[0], 1);
                    $s=substr($s, strlen($matches[0]));
                }

                $matches=[];
                $attributes=[];
                while (preg_match("/".self::$match["ATTR"]."/", $s, $matches)) {
                    $s=substr($s, strlen($matches[0]));
                    $attributes[$matches[1]]=$matches[3];
                }

                
                foreach ($this->children() as $node) {
                    if ($ss == "*") {
                        $q[] = $node;
                    } elseif (($tagName == "" || $node->tagName == $tagName)
                    && ($className == "" || in_array($className, $node->classList->values()))) {
                        if($attributes){
                            $result=true;
                            foreach($attributes as $k=>$v){
                                if($node->attributes[$k]!=$v){
                                    $result=false;
                                }
                            }
                            if($result){
                                $q[]=$node;
                            }
                        }else{
                            $q[] = $node;
                        }
                        
                    }

                    if (!$firstChild) {
                        $p = new Query($node);
                        foreach ($p->find($ss) as $node) {
                            $q[] = $node;
                        }
                    }
                }
            }
            return $q;
        } else {
            $s = array_shift($selectors);
            $r = $this->find($s)->find(implode(" ", $selectors));
            foreach ($r as $n) {
                $q[] = $n;
            }
        }

        return $q;
    }

    public function remove($selector)
    {
        if(isset($selector)){
            $this->find($selector)->remove();
        }else{
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
            unset($node->attributes[$attributeName]);
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
            $node->attributes["required"] = true;
        }
        return $this;
    }

    public function each($callback)
    {
        $i = 0;
        foreach ($this as $node) {
            $callback($i, $node);
            $i++;
        }
        return $this;
    }

    public function val($value)
    {
        if (!func_num_args()) {
            $node = $this[0];
            if ($node->tagName == "select") {
                foreach (p($node)->find("option") as $option) {
                    if ($option->attributes["selected"]) {
                        return $option->attributes["value"];
                    }
                }
            }
            return $node->attributes["value"];
        }
        foreach ($this as $node) {
            if ($node->tagName == "input") {
                $node->attributes["value"] = $value;
            } elseif ($node->tagName == "select") {
                if (!is_array($value)) {
                    $value = [$value];
                }
                foreach (p($node)->find("option") as $option) {
                    if (in_array($option->attributes["value"], $value)) {
                        $option->attributes["selected"] = true;
                    } else {
                        unset($option->attributes["selected"]);
                    }
                }
            } elseif ($node->tagName == "option") {
                $node->attributes["value"] = $value;
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
            $we = p($wrappingElement);
            $parent = $node->parentNode;
            $parent->replaceChild($we[0], $node);
            $we[0]->appendChild($node);
        }
        return $this;
    }

    public function wrapInner($wrappingElement)
    {
        foreach ($this as $node) {
            $we = p($wrappingElement);
            $we->append(p($node)->contents());
            p($node)->append($we);
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
            $index = p($node)->index();
            if ($index >= 1) {
                $index--;
                $q[] = p($node)->parent()->children()[$index];
            }
        }
        return $q;
    }

    public function next()
    {
        $q = new Query();
        foreach ($this as $node) {
            $index = p($node)->index();
            if ($index != -1) {
                $index++;
                // check size
                $count = p($node)->parent()->children()->count();
                if ($count >= $index) {
                    $q[] = p($node)->parent()->children()[$index];
                }
            }
        }
        return $q;
    }

    public function index()
    {
        $index = -1;
        $parent = $this->parent();

        if (!$parent) {
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
