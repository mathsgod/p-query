<?php
 // create by Raymond Chong
namespace P;

class Node
{
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

    public function normalize()
    {
        $found_text_node = null;
        $remove_nodes = [];
        foreach ($this->childNodes as $i => $node) {
            if ($node->nodeType == self::TEXT_NODE) {
                if ($found_text_node) {
                    $found_text_node->appendData($node->data);
                    $remove_nodes[] = $node;
                } else {
                    $found_text_node = $node;
                }
            } else {
                $found_text_node = null;
                $node->normalize();
            }
        }

        foreach ($remove_nodes as $node) {
            $this->removeChild($node);
        }
    }

    /*
    The Node.contains() method returns a Boolean value indicating whether a node is a descendant of a given node, 
    i.e. the node itself, one of its direct children (childNodes), one of the children's direct children, and so on.
     */
    public function contains(Node $otherNode)
    {
        if ($this == $otherNode) {
            return true;
        }
        foreach ($this->childNodes as $node) {
            if ($node->contains($otherNode)) {
                return true;
            }
        }
        return false;
    }

    public function hasChildNodes()
    {
        return count($this->childNodes) > 0;
    }

    public function appendChild(Node $newnode)
    {
        if ($newnode->parentNode) {
            $newnode->parentNode->removeChild($newnode);
        }

        if ($newnode instanceof DocumentFragment) {
            foreach ($newnode->childNodes as $node) {
                $this->appendChild($node);
            }
            return;
        }

        $newnode->parentNode = $this;
        $this->childNodes[] = $newnode;
    }

    public function insertBefore(Node $newNode, $referenceNode)
    {
        $position = array_search($referenceNode, $this->childNodes, true);
        if ($position === false) {
            $position = count($this->childNodes);
        }
        if ($newNode->parentNode) {
            $newNode->parentNode->removeChild($newNode);
        }
        $newNode->parentNode = $this;

        array_splice($this->childNodes, $position, 0, [$newNode]);
    }

    public function prependChild(Node $newnode)
    {
        if ($newnode->parentNode) {
            $newnode->parentNode->removeChild($newnode);
        }
        $newnode->parentNode = $this;
        array_unshift($this->childNodes, $newnode);
    }

    public function replaceChild(Node $newChild, Node $oldChild)
    {
        $this->insertBefore($newChild, $oldChild);
        return $this->removeChild($oldChild);
    }

    public function removeChild(Node $oldnode)
    {
        $this->childNodes = array_filter($this->childNodes, function ($node) use ($oldnode) {
            return $node !== $oldnode;
        });
        $oldnode->parentNode = null;
        return $oldnode;
    }

    public function __set($name, $value)
    {
        switch ($name) {
            case "textContent":
                $this->childNodes = [];
                $this->appendChild(new Text($value));
                break;
            default:
                $this->$name = $value;
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case "textContent":
                if ($this->nodeType == self::TEXT_NODE) {
                    return $this->wholeText;
                }
                $content = "";
                foreach ($this->childNodes as $node) {
                    $content .= $node->textContent;
                }
                return $content;
                break;
            case "firstChild":
                return count($this->childNodes) ? $this->childNodes[0] : null;
                break;
            case "lastChild":
                return end($this->childNodes);
                break;
            case "nextSibling":
                if ($parentNode = $this->parentNode) {
                    $index = array_search($this, $parentNode->childNodes, true);
                    return $parentNode->childNodes[$index + 1];
                } else {
                    return null;
                }
                break;
            case "previousSibling":
                if ($parentNode = $this->parentNode) {
                    $index = array_search($this, $parentNode->childNodes, true);
                    return $parentNode->childNodes[$index - 1];
                } else {
                    return null;
                }
                break;
        }
    }
}
