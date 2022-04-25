<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\Document;
use P\HTMLDivElement;
use P\HTMLFormElement;
use P\HTMLInputElement;
use P\HTMLLabelElement;
use PHPUnit\Framework\TestCase;


final class HTMLLabelTest extends TestCase
{
    function test_control()
    {
        $div = new HTMLDivElement();

        $input = new HTMLInputElement();
        $input->id = "test";
        $div->appendChild($input);

        $label = new HTMLLabelElement();
        $label->htmlFor = "test";

        $div->appendChild($label);

        $this->assertEquals($input, $label->control);
    }

    function test_form()
    {
        $form = new HTMLFormElement();

        $input = new HTMLInputElement();
        $input->id = "test_label";
        $form->appendChild($input);

        $label = new HTMLLabelElement();
        $label->htmlFor = "test_label";

        $form->appendChild($label);


        $this->assertEquals($form, $label->form);
    }
}
