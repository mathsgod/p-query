<?php
namespace P;

interface ParentNode
{
	public function append($nodes);
	public function prepend($nodes);
}