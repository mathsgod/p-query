<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\TypeError;

final class TypeErrorTest extends TestCase
{
    public function test_is_exception()
    {
        $this->assertInstanceOf(Exception::class, new TypeError("message"));
    }

    public function test_message()
    {
        $error = new TypeError("invalid type");
        $this->assertEquals("invalid type", $error->getMessage());
    }

    public function test_throw_and_catch()
    {
        $this->expectException(TypeError::class);
        throw new TypeError("boom");
    }
}
