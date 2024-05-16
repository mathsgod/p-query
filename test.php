<?php

use P\Document;
use P\HTMLButtonElement;
use P\HTMLDivElement;
use P\HTMLElement;
use P\HTMLFormElement;
use P\HTMLInputElement;
use P\HTMLLabelElement;
use P\HTMLOptionElement;
use P\HTMLParagraphElement;
use P\HTMLSelectElement;
use P\HTMLSpanElement;
use P\MutationObserver;

error_reporting(E_ALL && ~E_NOTICE);

require_once("vendor/autoload.php");

$div = p("<div></div>")[0];

print_R($div);
die();

$div = p("<div></div>")[0];

$div->innerHTML = "abc";

echo $div->outerHTML;

return;


$form = new HTMLFormElement();
$input = new HTMLInputElement();
$input->id = "test_input";
$form->appendChild($input);
$label = new HTMLLabelElement();
$label->htmlFor = "test_input";
$form->appendChild($label);

print_r($input->labels[0] == $label);

die();



$t = p("<input value='2020-01-01' >")[0];

var_dump($t->valueAsDate);
die();
$form = new HTMLFormElement();

$input = new HTMLInputElement();
$input->id = "test";
$form->appendChild($input);

$label = new HTMLLabelElement();
$label->htmlFor = "test";

$form->appendChild($label);


echo $form;
die();
print_R($label->control->form === $form);



die();

$div = new HTMLDivElement();

$input = new HTMLInputElement();
$input->id = "test";
$input->setIdAttribute("id", true);

$div->appendChild($input);



$label = new HTMLLabelElement();
$label->htmlFor = "test";

$div->appendChild($label);

print_r($label->control);
die();

$e = new HTMLButtonElement();
$e->value = "foo";
$e->value = "";
echo $e->getAttribute("value");
die();
$this->assertEquals("", $e->getAttribute("value"));

die();
$select = new HTMLSelectElement();
$select->multiple = true;
$select->append(new HTMLOptionElement("1"));
$select->append(new HTMLOptionElement("2"));
$select->append(new HTMLOptionElement("3"));
$select->append(new HTMLOptionElement("4"));


$select->options[1]->selected = true;
$select->options[3]->selected = true;

print_R($select->selectedOptions->item(1)->textContent);
die();



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
