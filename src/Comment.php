<?php
namespace P;

use DOMComment;

class Comment extends \DOMComment
{
    public function __toString()
    {
        return "<!--{$this->textContent}-->";
    }
}
