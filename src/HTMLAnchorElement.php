<?
namespace P;

class HTMLAnchorElement extends HTMLElement
{

    public function __construct($value = "", $uri = null)
    {
        parent::__construct("a", $value, $uri);
    }
}
