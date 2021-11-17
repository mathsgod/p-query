<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;

final class TextTest extends TestCase
{

    public function testCreate()
    {
        $e = new P\Text("hell");
        $this->assertInstanceOf(
            P\Text::class,
            $e
        );
    }

    public function textData()
    {
        $e = new P\Text("data");
        $this->assertEquals("data", $e->textContent);
    }
}
