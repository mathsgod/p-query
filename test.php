<?php

use P\Document;
use P\HTMLDivElement;
use P\HTMLElement;
use P\HTMLOptionElement;
use P\HTMLParagraphElement;
use P\HTMLSelectElement;
use P\HTMLSpanElement;
use P\MutationObserver;

error_reporting(E_ALL && ~E_NOTICE);

require_once("vendor/autoload.php");

$select = new HTMLSelectElement();
$select->append(new HTMLOptionElement("foo"));
$select->append(new HTMLOptionElement("bar"));

foreach (p($select)->find("option") as $option) {
    print_r($option);
}

die();

//$select->options[0]->selected = true;

echo $select;
die();




$s = p("<select><option value='1'>1</option><option value='2'>2</option></select>")[0];
$this->assertEquals(2, $s->options->length);

die();
$div = new HTMLDivElement();
$p = new HTMLParagraphElement();
$div->append("Some text", $p);

echo $div;
die();

$div = new HTMLDivElement();
$div->classList->add("container");
$div->innerText = "Hello world!";
$div->style->color = "red";



echo $div;


exit;

$p = p("<div id='1'><span>abc</span></div>");
print_r($p->find("span")->closest("div")->attr("id"));

exit;



$this->registerNodeClass("DOMNode", Node::class);
$div = new HTMLDivElement();
if ($div instanceof P\Node) {
    echo "yes";
}


die();

$div = new HTMLDivElement();
$span = new HTMLSpanElement();

$div->appendChild($span);


$mo = new MutationObserver(function ($records) {
    print_r($records);
});

$mo->observe($div, [
    "childList" => true,
    "subtree" => true

]);

$span1 = new HTMLSpanElement();

$span->appendChild($span1);

die();

//$div->classList
$div->style->backgroundColor = "red";
$div->style->color = "blue";

echo $div->style->length;
die();
$div->style->removeProperty("background-color");
echo $div->style->getPropertyValue("color");



die();




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
