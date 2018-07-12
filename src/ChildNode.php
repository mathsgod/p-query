<?php
namespace P;

interface ChildNode
{
    public function removes();
    public function before($nodes);
    public function after($nodes);
    public function replaceWith($nodes);
}