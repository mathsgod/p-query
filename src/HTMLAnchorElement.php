<?php

namespace P;

class HTMLAnchorElement extends HTMLElement
{
    const ATTRIBUTES = ["href" => "string", "hreflang" => "string", "media" => "string", "rel" => "string", "download" => "string", "charset" => "sstring"] + parent::ATTRIBUTES;
    public function __construct($value = "", $uri = null)
    {
        parent::__construct("a", $value, $uri);
    }
}