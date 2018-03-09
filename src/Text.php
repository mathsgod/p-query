<?php
namespace P;
class Text extends Node {
    public $textContent = "";

    public function __construct($value = "") {
        $this->textContent = $value;
        $this->nodeType = Node::TEXT_NODE;
    }

    public function __tostring() {
        // return $this-> htmlspecialchars((string)$value, ENT_COMPAT | ENT_HTML401| ENT_IGNORE)
        return (string)$this->textContent;
    }
}