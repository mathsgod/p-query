<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

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
        $input->id = "test";
        $form->append($input);

        $label = new HTMLLabelElement();
        $label->htmlFor = "test";

        $form->append($label);

        $this->assertEquals($form, $label->form);
    }
}
