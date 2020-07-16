<?php

declare(strict_types=1);
error_reporting(E_ALL && ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Document;

final class CSSStyleDeclarationTest extends TestCase
{

    public function test_cssText()
    {
        $doc = new Document();
        $div = $doc->createElement("div", "hello");
        $div->style->backgroundColor = "red";

        $this->assertEquals('background-color: red', $div->style->cssText);

        $div->style->color="green";

        $this->assertEquals('background-color: red; color: green', $div->style->cssText);
    }
}
