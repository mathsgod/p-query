<?php
namespace P;

use \DOMNode;

class Text extends \DOMText
{
    public function contains(DOMNode $otherNode)
    {
        if ($this == $otherNode) {
            return true;
        }
        return false;
    }

    public function __toString()
    {
        return $this->wholeText;
    }
}

