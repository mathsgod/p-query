<?php

namespace P;

class MutationRecord
{
    public string $type;

    public Element $target;

    /** @var array<int, \DOMNode> */
    public array $addedNodes = [];

    /** @var array<int, \DOMNode> */
    public array $removeNodes = [];
}
