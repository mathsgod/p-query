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
        switch ($name) {
            case "alt":
                return $this->getAttribute("alt");
            case "src":
                return $this->getAttribute("src");
            case "srcset":
                return $this->getAttribute("srcset");
            case "crossOrigin":
                return $this->getAttribute("crossorigin");
            case "useMap":
                return $this->getAttribute("usemap");
            case "width":
                return intval($this->getAttribute("width")) ?: 0;
            case "height":
                return intval($this->getAttribute("height")) ?: 0;
            case "referrerPolicy":
                return $this->getAttribute("referrerpolicy");
            default:
                return parent::__get($name);
        }
    }

    function __set($name, $value)
    {
        switch ($name) {
            case "alt":
                $this->setAttribute("alt", $value);
                break;
            case "src":
                $this->setAttribute("src", $value);
                break;
            case "srcset":
                $this->setAttribute("srcset", $value);
                break;
            case "crossOrigin":
                $this->setAttribute("crossorigin", $value);
                break;
            case "useMap":
                $this->setAttribute("usemap", $value);
                break;
            case "width":
                $this->setAttribute("width", $value);
                break;
            case "height":
                $this->setAttribute("height", $value);
                break;
            case "referrerPolicy":
                $this->setAttribute("referrerpolicy", $value);
                break;
            default:
                parent::__set($name, $value);
                break;
        }
    }
}
