<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\DOMTokenList;
use P\HTMLDivElement;
use PHPUnit\Framework\TestCase;

final class DOMTokenListTest extends TestCase
{

    function test_create()
    {
        $div = new HTMLDivElement();
        $this->assertInstanceOf(DOMTokenList::class, $div->classList);
    }

    function test_add()
    {
        $div = new HTMLDivElement();
        $div->classList->add("a");
        $div->classList->add("b");
        $div->classList->add("c");
        $div->classList->add("d", "e");
        $this->assertEquals(5, $div->classList->length);

        $div->classList->remove("a");
        $this->assertEquals(4, $div->classList->length);

        $div->classList->remove("b", "c");
        $this->assertEquals(2, $div->classList->length);
    }

    function test_replace()
    {
        $div = new HTMLDivElement();
        $div->classList->add("a", "b", "c");
        $result = $div->classList->replace("a", "d");

        $this->assertTrue($result);
        $this->assertTrue($div->classList->contains("d"));
        $this->assertEquals(3, $div->classList->length);
    }

    function test_toggle()
    {
        $div = new HTMLDivElement();
        $div->classList->add("a", "b", "c");
        $div->classList->toggle("a");
        $this->assertFalse($div->classList->contains("a"));

        $div->classList->toggle("a", true);
        $this->assertTrue($div->classList->contains("a"));

        $div->classList->toggle("d", false);
        $this->assertFalse($div->classList->contains("d"));
    }

    function test_values()
    {
        $div = new HTMLDivElement();
        $div->classList->add("a", "b", "c");
        $this->assertEquals(["a", "b", "c"], $div->classList->values());
    }

    function test_forEach()
    {
        $div = new HTMLDivElement();
        $div->classList->add("a", "b", "c");
        $values = [];
        $div->classList->forEach(function ($value) use (&$values) {
            $values[] = $value;
        });

        $this->assertEquals(["a", "b", "c"], $values);
    }
}
