<?php
namespace P;

use DOMAttr;

class Attr extends DOMAttr
{ 

    public function __toString()
    {
        return $this->value;
    }
}
