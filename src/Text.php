<?php
namespace P;

class Text extends Node
{
    public $data = "";

    public function __construct($value = "")
    {
        $this->data = $value;
        $this->nodeType = Node::TEXT_NODE;
    }

    public function __tostring()
    {
        // return $this-> htmlspecialchars((string)$value, ENT_COMPAT | ENT_HTML401| ENT_IGNORE)
        return (string)$this->data;
    }

    public function __get($name)
    {
        if ($name == "wholeText") {
            return $this->data;
        } elseif ($name == "length") {
            return strlen($this->data);
        }
        return parent::__get($name);
    }

    public function appendData($data)
    {
        $this->data .= $data;
    }



}