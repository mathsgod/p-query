<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Element;
use P\OptionCollection;

final class OptionCollectionTest extends TestCase
{
    public function test_basic_behavior()
    {
        $collection = new OptionCollection([
            new Element("option"),
        ]);

        $this->assertEquals(1, $collection->length);
        $this->assertInstanceOf(\P\HTMLOptionsCollection::class, $collection);
        $this->assertInstanceOf(\P\HTMLCollection::class, $collection);
    }
}
