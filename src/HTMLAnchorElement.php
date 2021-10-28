<?php

namespace P;

/**
 * @property string $href
 * @property string $hostname
 * @property string $pathname
 */
class HTMLAnchorElement extends HTMLElement
{
    const ATTRIBUTES = [
        "href" => "string",
        "hreflang" => "string",
        "media" => "string",
        "rel" => "string",
        "download" => "string",
        "charset" => "string"
    ] + parent::ATTRIBUTES;

    function __construct($value = "", $uri = null)
    {
        parent::__construct("a", $value, $uri);
    }

    function __get($name)
    {
        switch ($name) {
            case "hostname":
                return parse_url($this->href, PHP_URL_HOST);
            case "pathname":
                return parse_url($this->href, PHP_URL_PATH);
        }
        return parent::__get($name);
    }
}
