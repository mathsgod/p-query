<?php

namespace P;

class Element extends Node implements ChildNode
{
    const ClosedTag = ['input', 'hr', 'br', 'img', 'link', 'meta', 'base'];
    public $attributes = [];
    public $style = [];
    public $classList;
    public $tagName;
    public $dataset;

    public function __construct($name)
    {
        $this->tagName = $name;
        $this->nodeType = Node::ELEMENT_NODE;
        $this->dataset = new DOMStringMap($this);
        $this->classList = new DOMTokenList;
    }

    //extra function
    public function addClass($className)
    {
        foreach (explode(" ", $className) as $class) {
            $this->classList->add($class);
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
            return $this->attributes[$name];
        }

        $this->attributes[$name] = $value;

        return $this;
    }

    //--

    public function removes()
    {
        if ($parentNode = $this->parentNode) {
            $parentNode->removeChild($this);
        }
    }

    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function getAttribute($name)
    {
        return $this->attributes[$name];
    }

    public function hasAttributes()
    {
        return count($this->attributes) > 0;
    }

    public function hasAttribute($attName)
    {
        return isset($this->attributes[$attName]);
    }

    public function getElementsByTagName($tagName)
    {
        $tag = strtolower($tagName);
        $nodes = [];
        foreach ($this->childNodes as $node) {
            if (!$node instanceof Element) {
                continue;
            }
            if (strtolower($node->tagName) == $tag) {
                $nodes[] = $node;
            }
            foreach ($node->getElementsByTagName($tagName) as $n) {
                $nodes[] = $n;
            }
        }

        return $nodes;
    }

    public function getElementsByClassName($names)
    {
        $nodes = [];
        $names_arr = explode(" ", $names);
        $count = count($names_arr);
        foreach ($this->childNodes as $node) {
            if (!$node instanceof Element) {
                continue;
            }
            if (count(array_intersect($names_arr, $node->classList->values())) == $count) {
                $nodes[] = $node;

                foreach ($node->getElementsByClassName($names) as $n) {
                    $nodes[] = $n;
                }
            }
        }

        return $nodes;
    }

    public function __get($name)
    {

        if ($name == "id") {
            return $this->attributes["id"];
        } elseif ($name == "outerHTML") {
            $tagName = strtolower($this->tagName);

            foreach ($this->attributes as $n => $v) {
                if ($v === false) {
                    continue;
                }
                if ($v === true) {
                    $attr .= " $n";
                } elseif (is_array($v)) {
                    $attr .= " $n=\"" . htmlspecialchars(json_encode($v, JSON_UNESCAPED_UNICODE)) . "\"";
                } else {
                    $attr .= " $n=\"" . htmlspecialchars($v) . "\"";
                }
            }

            $css = "";
            if (sizeof($this->style)) {
                $css .= " style=\"";
                foreach ($this->style as $n => $v) {
                    $css .= "$n:" . htmlspecialchars($v) . ";";
                }
                $css .= "\"";
            }

            $class = "";
            if ($this->classList->length) {
                $class .= " class=\"";
                $class .= implode(" ", $this->classList->values());
                $class .= "\"";
            }

            return "<" . $tagName . $attr . $css . $class . ">" . $this->innerHTML . "</$tagName>";
        } elseif ($name == "innerText") {
            $html = "";
            foreach ($this->childNodes as $child) {
                if ($child instanceof Text) {
                    $html .= $child->wholeText;
                } else {
                    $html .= $child->innerText;
                }
            }
            return $html;
        } elseif ($name == "innerHTML") {
            foreach ($this->childNodes as $child) {
                if ($child instanceof Text) {
                    $html .= $child->wholeText;
                } else {
                    $html .= $child->outerHTML;
                }
            }
            return $html;
        }
        return parent::__get($name);
    }

    public function __set($name, $value)
    {

        if ($name == "id") {
            $this->attributes["id"] = $value;
        } elseif ($name == "innerHTML") {
            $this->childNodes = [];
            $p = new DOMParser($value);
            foreach ($p->nodes as $n) {
                $this->appendChild($n);
            }
        } elseif ($name == "innerText") {
            $this->childNodes = [];
            $this->appendChild(new Text($value));
        } else {
            parent::__set($name, $value);
        }
    }

    public function __toString()
    {
        $tagName = strtolower($this->tagName);

        foreach ($this->childNodes as $child) {
            if ($child instanceof Text) {
                if ($tagName == "script" || $tagName == "style") {
                    $html .= (string )$child->wholeText;
                } else {
                    $html .= htmlspecialchars($child->wholeText, ENT_COMPAT | ENT_HTML401 | ENT_IGNORE);
                }
            } else {
                $html .= $child;
            }
        }

        $attr = "";
        foreach ($this->attributes as $n => $v) {
            if ($v === false) {
                continue;
            }
            if ($v === true || $v === null) {
                $attr .= " $n";
            } elseif (is_array($v)) {
                $attr .= " $n=\"" . htmlspecialchars(json_encode($v, JSON_UNESCAPED_UNICODE)) . "\"";
            } elseif (!is_object($v)) {
                $attr .= " $n=\"" . htmlspecialchars($v) . "\"";
            }

        }

        $css = "";
        if (sizeof($this->style)) {
            $css .= " style=\"";
            foreach ($this->style as $n => $v) {
                $css .= "$n:" . htmlspecialchars($v) . ";";
            }
            $css .= "\"";
        }

        $class = "";
        if ($this->classList->length) {
            $class .= " class=\"";
            $class .= implode(" ", $this->classList->values());
            $class .= "\"";
        }

        $tagName = strtolower($this->tagName);
        if (in_array($tagName, self::ClosedTag)) {
            return "<" . $tagName . $attr . $css . $class . "/>";
        }

        if ($tagName == "!doctype") {
            return "<" . $tagName . $attr . $css . $class . ">";
        } else {
            return "<" . $tagName . $attr . $css . $class . ">" . $html . "</" . $tagName . ">";
        }
    }

    public function __call($name, $args)
    {
        $result = call_user_func_array([p($this), $name], $args);
        switch ($name) {
            case "find":
                return $result;
        }

        return $this;
    }
}
