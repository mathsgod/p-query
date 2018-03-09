<?php
namespace P;

class DOMStringMap
{
    private $element;
    public function __construct(Element &$e)
    {
        $this->element=$e;
    }

    public function __set($name, $value)
    {
       $name=preg_replace_callback("/[A-Z]+/", function ($a) {
            return "-"  .strtolower($a[0]);
        }, $name);

        $this->element->attributes["data-".$name]=$value;
    }

    public function __get($name)
    {
        $name=preg_replace_callback("/[A-Z]+/", function ($a) {
            return "-"  .strtolower($a[0]);
        }, $name);

         return $this->element->attributes["data-".$name];
    }
}
