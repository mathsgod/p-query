<?php

namespace P;

class HTMLImageElement extends HTMLElement
{
    const ATTRIBUTES = ["alt" => "string", "height" => "int", "isMap" => ["type" => "bool", "name" => "ismap"], "src" => "string", "width" => "int"] + parent::ATTRIBUTES;
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("img", $value, $uri);
    }
}