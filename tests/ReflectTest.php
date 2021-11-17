<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\Reflect;
use PHPUnit\Framework\TestCase;

final class ReflectTest extends TestCase
{
    function test_apply()
    {
        $results = Reflect::apply(function ($value) {
            return $value * 2;
        }, null, [1]);
        $this->assertEquals(2, $results);
    }

    function test_has()
    {
        $obj = new stdClass();
        $obj->property1 = 42;
        $this->assertTrue(Reflect::has($obj, 'property1'));
        $this->assertFalse(Reflect::has($obj, 'property2'));
    }
}
