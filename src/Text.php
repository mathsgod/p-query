<?php

namespace P;

use \DOMNode;

class Text extends \DOMText
{
    public function __construct(string $data = "")
    {
        parent::__construct($data);
        Document::Current()->appendChild($this);
    }

    public function contains(DOMNode $otherNode): bool
    {
        return $this === $otherNode;
    }

    public function __toString(): string
    {
        return $this->wholeText;
    }
}
