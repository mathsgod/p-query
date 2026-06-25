<?php
namespace P;

class Comment extends \DOMComment
{
    public function __toString(): string
    {
        return "<!--{$this->textContent}-->";
    }
}
