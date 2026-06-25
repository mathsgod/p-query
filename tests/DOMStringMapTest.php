<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Document;

final class DOMStringMapTest extends TestCase
{
    public function test_set_and_get_camelCase()
    {
        $doc = new Document();
        $div = $doc->createElement("div");
        $div->dataset->fooBar = "value1";

        $this->assertEquals("value1", $div->dataset->fooBar);
        $this->assertEquals("value1", $div->getAttribute("data-foo-bar"));
    }

    public function test_get_existing_attribute()
    {
        $doc = new Document();
        $div = $doc->createElement("div");
        $div->setAttribute("data-user-id", "123");

        $this->assertEquals("123", $div->dataset->userId);
    }

    public function test_single_word()
    {
        $doc = new Document();
        $div = $doc->createElement("div");
        $div->dataset->name = "test";

        $this->assertEquals("test", $div->getAttribute("data-name"));
    }
}
