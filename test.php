<?php

use P\HTMLElement;

error_reporting(E_ALL && ~E_NOTICE);

require_once("vendor/autoload.php");

$div=p("<div></div>");

$form=new HTMLElement("form");
$button=new HTMLElement("button");

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
