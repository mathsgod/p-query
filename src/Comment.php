<?php
namespace P;
class Comment extends Node {
    public $textContent;

    public function __construct($data) {
        $this->textContent = $data;
        $this->nodeType = Node::COMMENT_NODE;
    }

    public function __toString() {
        return "<!--{$this->textContent}-->";
    }
}