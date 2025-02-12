<?php

namespace P;

/**
 * @property string $alt
 * @property string $src
 * @property string $srcset
 * @property string $crossOrigin
 * @property string $useMap
 * @property int $width
 * @property int $height
 * @property string $referrerPolicy
 * 
 */
class HTMLImageElement extends HTMLElement
{
    public function __construct(string $value = "", string $uri = null)
    {
        parent::__construct("img", $value, $uri);
    }

    function __get($name)
    {
        $attributes = [
            "alt" => "alt",
            "src" => "src",
            "srcset" => "srcset",
            "crossOrigin" => "crossorigin",
            "useMap" => "usemap",
            "width" => "width",
            "height" => "height",
            "referrerPolicy" => "referrerpolicy"
        ];

        if (array_key_exists($name, $attributes)) {
            $value = $this->getAttribute($attributes[$name]);
            return in_array($name, ["width", "height"]) ? intval($value) : $value;
        }

        return parent::__get($name);
    }

    function __set($name, $value)
    {
        $attributes = [
            "alt" => "alt",
            "src" => "src",
            "srcset" => "srcset",
            "crossOrigin" => "crossorigin",
            "useMap" => "usemap",
            "width" => "width",
            "height" => "height",
            "referrerPolicy" => "referrerpolicy"
        ];

        if (array_key_exists($name, $attributes)) {
            $this->setAttribute($attributes[$name], $value);
        } else {
            parent::__set($name, $value);
        }
    }
}
