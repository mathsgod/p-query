<?
namespace P;

class HTMLSpanElement extends HTMLElement
{
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("span", $value, $uri);
    }
}
