<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Element;
use P\HTMLFormControlsCollection;

final class HTMLFormControlsCollectionTest extends TestCase
{
    public function test_length_and_item()
    {
        $collection = new HTMLFormControlsCollection([
            new Element("input"),
            new Element("button"),
        ]);

        $this->assertEquals(2, $collection->length);
        $this->assertEquals("input", $collection->item(0)->tagName);
        $this->assertEquals("button", $collection->item(1)->tagName);
    }

    public function test_inheritance()
    {
        $collection = new HTMLFormControlsCollection([]);
        $this->assertInstanceOf(\P\HTMLCollection::class, $collection);
    }
}
