<?php

namespace P;

use DOMNode;

/**
 * @property string $cssText
 * @property string $backgroundColor
 * @property string $backgroundImage
 * @property string $color
 * @property string $cursor
 * @property string $direction
 * @property string $display
 * @property string $filter
 * @property string $font
 * @property string $fontFamily
 * @property string $fontSize
 * @property string $fontStyle
 * @property string $fontVariant
 * @property string $fontWeight
 * @property string $height
 * @property string $left
 * @property string $letterSpacing
 * @property string $lineHeight
 * @property string $listStyle
 * @property string $listStyleImage
 * @property string $listStylePosition
 * @property string $listStyleType
 * @property string $margin
 * @property string $marginBottom
 * @property string $marginLeft
 * @property string $marginRight
 * @property string $marginTop
 * @property string $maxHeight
 * @property string $maxWidth
 * @property string $minHeight
 * @property string $minWidth
 * @property string $opacity
 * @property string $outline
 * @property string $outlineColor
 * @property string $outlineOffset
 * @property string $outlineStyle
 * @property string $outlineWidth
 * @property string $overflow
 * @property string $overflowX
 * @property string $overflowY
 * @property string $padding
 * @property string $paddingBottom
 * @property string $paddingLeft
 * @property string $paddingRight
 * @property string $paddingTop
 * @property string $position
 * @property string $right
 * @property string $textAlign
 * @property string $textDecoration
 * @property string $textIndent
 * @property string $top
 * @property string $transform
 * @property string $transformOrigin
 * @property string $verticalAlign
 * @property string $visibility
 * @property string $width
 * @property string $wordSpacing
 * @property string $zIndex
 * @property-read string $length
 */

class CSSStyleDeclaration
{
    private $node;

    public function __construct(DOMNode $node)
    {
        $this->node = $node;
    }

    /**
     * Returns a CSS property name by its index, or the empty string if the index is out-of-bounds.
     */
    function item(int $index): string
    {
        $values = [];
        foreach (explode(";", $this->node->nodeValue) as $v) {
            if (!$v) continue;
            list($a, $b) = explode(":", $v);
            $values[] = trim($a);
        }
        return $values[$index] ?? "";
    }

    /**
     * Removes a property from the CSS declaration block
     */
    public function removeProperty(string $property)
    {
        $old_value = $this->__get($property);
        $this->__set($property, null);
        return $old_value;
    }

    /**
     * Returns the property value given a property name.
     */
    function getPropertyValue(string $property): string
    {
        return $this->__get($property) ?? "";
    }

    /**
     * Modifies an existing CSS property or creates a new CSS property in the declaration block.
     */
    function setProperty(string $property, string $value, string $priority = null)
    {
        $this->__set($property, $value);
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
            case "length":
                return count(explode(";", $this->node->nodeValue));
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
