<?php
// create by Raymond Chong
namespace P;
class Node {
    const ELEMENT_NODE = 1;
    const TEXT_NODE = 3;
    const PROCESSING_INSTRUCTION_NODE = 7;
    const COMMENT_NODE = 8;
    const DOCUMENT_NODE = 9;
    const DOCUMENT_TYPE_NODE = 10;
    const DOCUMENT_FRAGMENT_NODE = 11;

    private $nodeName;
    public $nodeType;

    public $childNodes = [];
    public $parentNode = null;

    public function normalize() {
    }

    public function hasChildNodes() {
        return count($this->childNodes) > 0;
    }

    public function appendChild(Node $newnode) {
        if ($newnode->parentNode) {
            $newnode->parentNode->removeChild($newnode);
        }

        if ($newnode instanceof DocumentFragment) {
            foreach($newnode->childNodes as $node) {
                $this->appendChild($node);
            }
            return;
        }

        $newnode->parentNode = $this;
        $this->childNodes[] = $newnode;
    }

    public function insertBefore(Node $newNode, $referenceNode) {
        $position = array_search($referenceNode, $this->childNodes, true);
    	if($position===false){
    		$position=count($this->childNodes);
    	}
    	if ($newNode->parentNode) {
            $newNode->parentNode->removeChild($newNode);
        }
        $newNode->parentNode = $this;

        array_splice($this->childNodes, $position, 0, [$newNode]);
    }

    public function prependChild(Node $newnode) {
        if ($newnode->parentNode) {
            $newnode->parentNode->removeChild($newnode);
        }
        $newnode->parentNode = $this;
        array_unshift($this->childNodes, $newnode);
    }

    public function replaceChild(Node $newChild, Node $oldChild) {
        if ($newChild->parentNode)$newChild->parentNode->removeChild($newChild);
        $newChild->parentNode = $this;
        $this->insertBefore($newChild, $oldChild);
        return $this->removeChild($oldChild);
    }

    public function removeChild(Node $oldnode) {
        $this->childNodes = array_filter($this->childNodes, function($node)use($oldnode) {
                return $node !== $oldnode;
            }
            );
        $oldnode->parentNode = null;
        return $oldnode;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        if ($name == "firstChild") {
            return count($this->childNodes)?$this->childNodes[0]:null;
        } elseif ($name == "lastChild") {
            return end($this->childNodes);
        } elseif ($name == "nextSibling") {
            if ($parentNode = $this->parentNode) {
                $index = array_search($this, $parentNode->childNodes, true);
                return $parentNode->childNodes[$index + 1];
            } else {
                return null;
            }
        } elseif ($name == "previousSibling") {
            if ($parentNode = $this->parentNode) {
                $index = array_search($this, $parentNode->childNodes, true);
                return $parentNode->childNodes[$index - 1];
            } else {
                return null;
            }
        } elseif ($name == "nextElementSibling") {
            $e = $this->nextSibling;
            while ($e && $e->nodeType !== 1) {
                $e = $e->nextSibling;
            }
            return $e;
        }
    }
}

?>