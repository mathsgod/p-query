<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use P\HTMLFormElement;
use P\HTMLInputElement;
use PHPUnit\Framework\TestCase;

final class HTMLInputElementTest extends TestCase
{

    public function test_form()
    {

        $input = new HTMLInputElement();

        $form = new HTMLFormElement();

        $form->append($input);

        $this->assertEquals($form, $input->form);
    }
}
