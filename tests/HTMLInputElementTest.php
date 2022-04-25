<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\HTMLFormElement;
use P\HTMLInputElement;
use P\HTMLLabelElement;
use PHPUnit\Framework\TestCase;

final class HTMLInputElementTest extends TestCase
{
    public function test_labels()
    {
        $form = new HTMLFormElement();
        $input = new HTMLInputElement();
        $input->id = "test_input_111";
        $form->appendChild($input);
        $label = new HTMLLabelElement();
        $label->htmlFor = "test_input_111";
        $form->appendChild($label);
        $this->assertEquals($label, $input->labels[0]);
    }

    public function test_form()
    {

        $input = new HTMLInputElement();

        $form = new HTMLFormElement();

        $form->append($input);

        $this->assertEquals($form, $input->form);
    }
}
