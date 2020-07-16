<?php
namespace P;
use DOMNode;

/**
 * @property string $backgroundColor
 */
class CSSStyleDeclaration
{
    private $node;
    public function __construct(DOMNode $node)
    {
        $this->node = $node;
    }

    public function __set($name, $value)
    {

        $name = preg_replace_callback("/[A-Z]+/", function ($a) {
            return "-"  . strtolower($a[0]);
        }, $name);

        $values = [];
        foreach (explode(";", $this->node->nodeValue) as $v) {
            list($a, $b) = explode(":", $v);
            $values[$a] = $b;
        }

        $values[$name] = $value;

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
            $values[$a] = $b;
        }

        $name = preg_replace_callback("/[A-Z]+/", function ($a) {
            return "-"  . strtolower($a[0]);
        }, $name);

        
        return $values[$name];
    }
}
