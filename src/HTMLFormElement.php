<?
namespace P;

class  HTMLFormElement extends HTMLElement
{
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("form", $value, $uri);
    }
}

