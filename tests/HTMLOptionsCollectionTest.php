<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Element;
use P\HTMLOptionsCollection;

final class HTMLOptionsCollectionTest extends TestCase
{
    public function test_length_and_item()
    {
        $collection = new HTMLOptionsCollection([
            new Element("option"),
            new Element("option"),
        ]);

        $this->assertEquals(2, $collection->length);
        $this->assertEquals("option", $collection->item(0)->tagName);
    }

    public function test_inheritance()
    {
        $collection = new HTMLOptionsCollection([]);
        $this->assertInstanceOf(\P\HTMLCollection::class, $collection);
    }
}
