<?php

namespace P;

/**
 * @property string $name
 * @property string $method
 * @property string $target
 * @property string $action
 * @property string $acceptCharset
 * @property string $autocomplete
 * @property string $encoding
 * @property string $enctype
 * @property bool $noValidate
 */
class HTMLFormElement extends HTMLElement
{
    private const array STRING_ATTRIBUTES = [
        "name",
        "method",
        "target",
        "action",
        "autocomplete",
        "encoding",
        "enctype",
    ];

    public function __construct(string|null $value = "", string|null $namespace = null)
    {
        parent::__construct("form", $value, $namespace);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        if (in_array($name, self::STRING_ATTRIBUTES, true)) {
            $this->setAttribute($name, $value);
        } elseif ($name === "acceptCharset") {
            $this->setAttribute("accept-charset", $value);
        } elseif ($name === "noValidate") {
            if ($value) {
                $this->setAttribute("novalidate", true);
            } else {
                $this->removeAttribute("novalidate");
            }
        } else {
            parent::__set($name, $value);
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (in_array($name, self::STRING_ATTRIBUTES, true)) {
            return $this->getAttribute($name);
        }

        if ($name === "acceptCharset") {
            return $this->getAttribute("accept-charset");
        }

        if ($name === "noValidate") {
            return $this->hasAttribute("novalidate");
        }

        return parent::__get($name);
    }
}
