<?php
namespace P;

class HTMLOptGroupElement extends HTMLElement
{
    const ATTRIBUTES = [
        "disabled" => "bool",
        "label" => "string"
    ] + parent::ATTRIBUTES;
}
