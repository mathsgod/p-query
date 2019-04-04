<?
namespace P;

class HTMLImageElement extends HTMLElement
{
    const ATTRIBUTES = [
        "alt" => "string",
        "height" => "int",
        "isMap" => ["type" => "bool", "name" => "ismap"],
        "src" => "string",
        "width" => "int"
    ] + parent::ATTRIBUTES;
}
