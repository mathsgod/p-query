<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\HTMLFormElement;
use P\HTMLOptionElement;
use P\HTMLOptionsCollection;
use P\HTMLSelectElement;
use P\OptionCollection;

final class HTMLSelectElementTest extends TestCase
{

    public function test_multiple()
    {
        $select = new HTMLSelectElement();
        $select->multiple = true;
        $this->assertTrue($select->multiple);
        $select->multiple = false;
        $this->assertFalse($select->multiple);
    }

    public function test_length()
    {
        $select = new HTMLSelectElement();
        $this->assertEquals(0, $select->length);

        $select->append(new HTMLOptionElement("foo"));
        $this->assertEquals(1, $select->length);

        $select->append(new HTMLOptionElement("bar"));
        $this->assertEquals(2, $select->length);
    }

    public function test_form()
    {

        $form = new HTMLFormElement();
        $select = new HTMLSelectElement();
        $form->append($select);
        $this->assertEquals($select->form, $form);
    }


    public function test_value()
    {

        $s = p("<select><option value='1'>1</option><option value='2'>2</option></select>")[0];

        $s->value = 2;

        $this->assertEquals('<select><option value="1">1</option><option value="2" selected>2</option></select>', str_replace("\n", "", (string)$s));

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
        $select = new HTMLSelectElement();
        $this->assertInstanceOf(HTMLOptionsCollection::class, $select->options);
        $this->assertEquals(0, $select->options->length);

        $select->append(new HTMLOptionElement("foo"));
        $this->assertEquals(1, $select->options->length);

        $select->append(new HTMLOptionElement("bar"));
        $this->assertEquals(2, $select->options->length);
    }
}
