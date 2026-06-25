<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\DOMParser;
use P\Element;

final class DOMParserTest extends TestCase
{
    public function test_parse_single_element()
    {
        $parser = new DOMParser();
        $nodes = $parser->parseFromString("<span>hello</span>");

        $this->assertCount(1, $nodes);
        $this->assertInstanceOf(Element::class, $nodes[0]);
        $this->assertEquals("span", $nodes[0]->tagName);
        $this->assertEquals("hello", $nodes[0]->textContent);
    }

    public function test_parse_multiple_nodes()
    {
        $parser = new DOMParser();
        $nodes = $parser->parseFromString("<p>a</p><p>b</p>");

        $this->assertCount(2, $nodes);
        $this->assertEquals("p", $nodes[0]->tagName);
        $this->assertEquals("p", $nodes[1]->tagName);
    }

    public function test_parse_with_class()
    {
        $parser = new DOMParser();
        $nodes = $parser->parseFromString("<div class='box'></div>");

        $this->assertEquals("box", $nodes[0]->getAttribute("class"));
    }

    public function test_parse_unicode()
    {
        $parser = new DOMParser();
        $nodes = $parser->parseFromString("<div>中文</div>");

        $this->assertEquals("中文", $nodes[0]->textContent);
    }
}
