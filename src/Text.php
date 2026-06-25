<?php

namespace P;

class Text extends \DOMText
{
    public function __construct(string $data = "")
    {
        parent::__construct($data);
        Document::Current()->appendChild($this);
    }

    public function __toString(): string
    {
        return $this->wholeText;
    }
}
