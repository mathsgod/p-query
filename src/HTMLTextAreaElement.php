<?
namespace P;

class HTMLTextAreaElement extends HTMLElement
{
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("textarea", $value, $uri);
    }

    public function __set($name, $value)
    {
        switch ($name) {
            case "autocomplete":
            case "autofocus":
            case "cols":
            case "dirName":
            case "disabled":
            case "maxLength":
            case "minLength":
            case "name":
            case "placeholder":
            case "readOnly":
            case "required":
            case "rows":
            case "wrap":
            case "type":
            case "defaultValue":
            case "value":
                $this->setAttribute($name, $value);
                break;
            default:
                parent::__set($name, $value);
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case "autocomplete":
            case "autofocus":
            case "cols":
            case "dirName":
            case "disabled":
            case "maxLength":
            case "minLength":
            case "name":
            case "placeholder":
            case "readOnly":
            case "required":
            case "rows":
            case "wrap":
            case "type":
                return $this->getAttribute($name);
                break;
            case "textLength":
                return strlen($this->nodeValue);
            case "value":
                return $this->nodeValue;
            default:
                return parent::__get($name);
        }
    }
}
