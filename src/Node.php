<?php
// create by Raymond Chong
namespace P;

use DOMNode;

class Node extends DOMNode
{
    public function contains(Node $otherNode): bool
    {
        if ($this === $otherNode) {
            return true;
        }

        return false;
    }
}
