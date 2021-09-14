<?php

use P\Document;
use P\HTMLDivElement;
use P\HTMLElement;
use P\HTMLSpanElement;

error_reporting(E_ALL && ~E_NOTICE);

require_once("vendor/autoload.php");

$div = new HTMLDivElement();
$div->innerHTML = "<div data-a='1' data-b='2' data-x-y='z'></div>";


$child = $div->firstChild;

print_r($child->dataset->a);
die();

$current = Document::Current();

$current->formatOutput = true;


$div = new HTMLDivElement();
$div->append(new HTMLSpanElement("hello"));


die();
$form = new HTMLElement("form");
$button = new HTMLElement("button");

$form->append($button);
echo $form;
die();


$div->append($span);
echo $div;
die();

$p = p('<div class="container">
    <div class="hello">Hello</div>
</div>');

$p->find(".hello")->text("abc");

echo $p; /*output 
<div class="container">
    <div class="hello">abc</div>
</div>
*/
