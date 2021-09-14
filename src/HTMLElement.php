<?php

namespace P;

/**
 * @property-read DOMStringMap $dataset
 */
class HTMLElement extends Element
{

    const ATTRIBUTES = [
        "accessKey" => ["type" => "string", "name" => "accesskey"],
        "contentEditable" => ["type" => "string", "name" => "contenteditable"],
        "dir" => "string",
        "draggable" => "bool",
        "hidden" => "boolean",
        "lang" => "string",
        "tabIndex" => "int",
        "title" => "string",
    ];

    public function __set($name, $value)
    {
        switch ($name) {
            case "innerText":
                $this->textContent = $value;
                return;
                break;
        }

        if (array_key_exists($name, static::ATTRIBUTES)) {

            $attr = static::ATTRIBUTES[$name];
            if (is_array($attr)) {
                $name = $attr["name"];
                $type = $attr["type"];
            } else {
                $name = strtolower($name);
                $type = "string";
            }


            if ($type == "json") {
                $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            }

            $this->setAttribute($name, $value);
            return;
        }
        parent::__set($name, $value);
    }

    public function __get($name)
    {
        switch ($name) {
            case "dataset":
                $map = new DOMStringMap($this);
                return $map;
                break;
            case 'innerText':
                return $this->textContent;
                break;
        }

        if (array_key_exists($name, static::ATTRIBUTES)) {
            $attr = static::ATTRIBUTES[$name];
            if (is_array($attr)) {
                $name = $attr["name"];
                $type = $attr["type"];
            } else {
                $name = strtolower($name);
                $type = "string";
            }

            $value = $this->getAttribute($name);

            if ($type == "json") {
                $value = json_decode($value, true);
            }
            return $value;
        }
        return parent::__get($name);
    }
}
