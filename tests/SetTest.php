<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\Reflect;
use P\Set;
use PHPUnit\Framework\TestCase;

final class SetTest extends TestCase
{
    function test_size()
    {
        $set = new Set([1, 2, 3]);
        $this->assertEquals(3, $set->size);
    }

    function test_forEach()
    {
        $set = new Set([1, 2, 3]);
        $result = [];
        $set->forEach(function ($value) use (&$result) {
            $result[] = $value * 2;
        });

        $this->assertEquals([2, 4, 6], $result);
    }
}
