<?php
declare (strict_types = 1);
error_reporting(E_ALL & ~E_WARNING);
use PHPUnit\Framework\TestCase;
use P\SelectCollection;

final class HTMLOptionElementTest extends TestCase
{
    public function test_value()
    {

        $opt = p("<option value='3'>3</option>")[0];
        $this->assertEquals(3, $opt->value);
    }
}
