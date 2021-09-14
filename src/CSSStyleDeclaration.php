<?php

namespace P;

use ArrayIterator;
use DOMNode;
use IteratorAggregate;

/**
 * @property string $backgroundColor
 * @property string $backgroundImage
 * @property string $color
 * @property string $cssText
 */

class CSSStyleDeclaration
{
    private $node;

    public function __construct(DOMNode $node)
    {
        $this->node = $node;
    }

    public function removeProperty(string $property)
    {
        $old_value = $this->__get($property);
        $this->__set($property, null);

        return $old_value;
    }

    public function getPropertyValue(string $property): string
    {
        return $this->__get($property) ?? "";
    }

    public function __set($name, $value)
    {
        $name = preg_replace_callback("/[A-Z]+/", function ($a) {
            return "-"  . strtolower($a[0]);
        }, $name);

        $values = [];
        foreach (explode(";", $this->node->nodeValue) as $v) {
            if (!$v) continue;
            list($a, $b) = explode(":", $v);
            $values[trim($a)] = trim($b);
        }


        if (is_null($value)) {
            unset($values[$name]);
        } else {
            $values[$name] = $value;
        }

        $str = [];
        foreach ($values as $n => $v) {
            $str[] = $n . ": $v";
        }


        $this->node->nodeValue = implode("; ", $str);
    }

    public function __get($name)
    {
        switch ($name) {
            case "cssText":
                return $this->node->nodeValue;
                break;
        }

        $values = [];
        foreach (explode(";", $this->node->nodeValue) as $v) {
            list($a, $b) = explode(":", $v);
            $values[$a] = trim($b);
        }

        $name = preg_replace_callback("/[A-Z]+/", function ($a) {
            return "-"  . strtolower($a[0]);
        }, $name);


        return $values[$name];
    }
}
