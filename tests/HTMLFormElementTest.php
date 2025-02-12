<?php
use PHPUnit\Framework\TestCase;
use P\HTMLFormElement;

class HTMLFormElementTest extends TestCase
{
    public function testSetAndGetAttributes()
    {
        $form = new HTMLFormElement();

        $form->name = "testForm";
        $this->assertEquals("testForm", $form->name);

        $form->method = "post";
        $this->assertEquals("post", $form->method);

        $form->target = "_blank";
        $this->assertEquals("_blank", $form->target);

        $form->action = "/submit";
        $this->assertEquals("/submit", $form->action);

        $form->acceptCharset = "UTF-8";
        $this->assertEquals("UTF-8", $form->acceptCharset);

        $form->autocomplete = "on";
        $this->assertEquals("on", $form->autocomplete);

        $form->encoding = "multipart/form-data";
        $this->assertEquals("multipart/form-data", $form->encoding);

        $form->enctype = "application/x-www-form-urlencoded";
        $this->assertEquals("application/x-www-form-urlencoded", $form->enctype);

        $form->noValidate = true;
        $this->assertTrue($form->noValidate);

        $form->noValidate = false;
        $this->assertFalse($form->noValidate);
    }
}