<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Element;
use P\HTMLCollection;

final class HTMLCollectionTest extends TestCase
{
    public function test_length()
    {
        $collection = new HTMLCollection([
            new Element("span"),
            new Element("p"),
        ]);

        $this->assertEquals(2, $collection->length);
    }

    public function test_item()
    {
        $span = new Element("span");
        $collection = new HTMLCollection([$span]);

        $this->assertEquals($span, $collection->item(0));
        $this->assertNull($collection->item(99));
    }

    public function test_array_access()
    {
        $span = new Element("span");
        $p = new Element("p");
        $collection = new HTMLCollection([$span, $p]);

        $this->assertEquals($span, $collection[0]);
        $this->assertEquals($p, $collection[1]);
    }

    public function test_empty_collection()
    {
        $collection = new HTMLCollection([]);
        $this->assertEquals(0, $collection->length);
    }
}
