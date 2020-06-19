<?php
declare (strict_types = 1);
error_reporting(E_ALL && ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Document;
use P\OptionCollection;

final class HTMLSelectElementTest extends TestCase
{
    public function test_value()
    {

        $s = p("<select><option value='1'>1</option><option value='2'>2</option></select>")[0];

        $s->value = 2;

        $this->assertEquals('<select><option value="1">1</option><option value="2" selected>2</option></select>', str_replace("\n","",$s));

        $this->assertEquals("2", $s->value);
    }

    public function test_required()
    {
        $s = p("<select></select>")[0];
        $s->required = true;
        $this->assertEquals('<select required></select>', (string)$s);

        $s = p("<select></select>")[0];
        $s->required = false;
        $this->assertEquals('<select></select>', (string)$s);
    }

    public function test_options()
    {
        $s = p("<select><option value='1'>1</option><option value='2'>2</option></select>")[0];
        $this->assertEquals(2, $s->options->length);
        $this->assertInstanceOf(OptionCollection::class, $s->options);
    }

    public function test_length()
    {
        $s = p("<select><option value='1'>1</option><option value='2'>2</option></select>")[0];

        $this->assertEquals("2", $s->length);
    }
}
