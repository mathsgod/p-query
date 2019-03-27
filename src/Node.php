<?php
 // create by Raymond Chong
namespace P;

class Node extends \DOMNode
{
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
}

