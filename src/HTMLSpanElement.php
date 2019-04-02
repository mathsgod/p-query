<?
namespace P;

class HTMLSpanElement extends Element
{
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("span", $value, $uri);
    }
}
