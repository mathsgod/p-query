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
 */
class HTMLImageElement extends HTMLElement
{
    private const array ATTRIBUTES = [
        "alt" => "alt",
        "src" => "src",
        "srcset" => "srcset",
        "crossOrigin" => "crossorigin",
        "useMap" => "usemap",
        "width" => "width",
        "height" => "height",
        "referrerPolicy" => "referrerpolicy",
    ];

    private const array INTEGER_ATTRIBUTES = ["width", "height"];

    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("img", $value, $namespace);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, self::ATTRIBUTES)) {
            $value = $this->getAttribute(self::ATTRIBUTES[$name]);
            return in_array($name, self::INTEGER_ATTRIBUTES, true) ? intval($value) : $value;
        }

        return parent::__get($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        if (array_key_exists($name, self::ATTRIBUTES)) {
            $this->setAttribute(self::ATTRIBUTES[$name], $value);
        } else {
            parent::__set($name, $value);
        }
    }
}
