<?php
namespace P;

use \DOMNode;

class Text extends \DOMText
{
    public function contains(DOMNode $otherNode): bool
    {
        if ($this == $otherNode) {
            return true;
        }
        return false;
    }

    public function __toString(): string
    {
        return $this->wholeText;
    }
}
