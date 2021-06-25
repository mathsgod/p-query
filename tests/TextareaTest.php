<?php
declare (strict_types = 1);
error_reporting(E_ALL & ~E_WARNING);
use PHPUnit\Framework\TestCase;
use P\Document;

final class TextareaTest extends TestCase
{
    public function test_get_set()
    {
        $doc = new Document();
        $t = $doc->createElement("textarea");
        $t->name = "input1";
        $this->assertEquals((string)$t, '<textarea name="input1"></textarea>');


        $t = p("<textarea name='input1'></textarea>")[0];

        $this->assertEquals($t->name, "input1");
    }

    public function test_textLength(){
        $t = p("<textarea name='input1'>1234</textarea>")[0];

        $this->assertEquals($t->textLength, 4);

    }

    public function test_value(){
        $t = p("<textarea name='input1'>1234</textarea>")[0];

        $this->assertEquals($t->value, "1234");

    }

}
