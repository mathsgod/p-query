<?php
declare (strict_types = 1);
error_reporting(E_ALL && ~E_WARNING);
use PHPUnit\Framework\TestCase;
use P\SelectCollection;

final class SelectCollectionTest extends TestCase
{
    public function test_options()
    {
        $select = p("<select data-value='2'></select>")[0];

        $collect = new SelectCollection();
        $collect[] = $select;


        $opt = [1, 2, 3, 4];
        $collect->options($opt);


        $this->assertEquals("2", $select->value);
    }

    public function test_ds()
    {
        $select = p("<select data-value='2' data-field='v'></select>")[0];

        $collect = new SelectCollection();
        $collect[] = $select;


        $opt = [
            ["v" => 1],
            ["v" => 2],
            ["v" => 3],
            ["v" => 4]
        ];

        $collect->ds($opt,"v");

        $this->assertEquals("2", $select->value);
    }
}
