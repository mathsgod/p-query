<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Attr;
use P\Document;

final class AttrTest extends TestCase
{
    public function test_toString()
    {
        $doc = new Document();
        $attr = $doc->createAttribute("class");
        $this->assertInstanceOf(Attr::class, $attr);
        $attr->value = "container";
        $this->assertEquals("container", (string)$attr);
    }

    public function test_empty_value()
    {
        $doc = new Document();
        $attr = $doc->createAttribute("disabled");
        $attr->value = "";
        $this->assertEquals("", (string)$attr);
    }
}
