<?
error_reporting(E_ALL & ~E_NOTICE);

require_once(__DIR__ . "/vendor/autoload.php");
use P\HTMLElement;
use P\HTMLTableSectionElement;
use P\HTMLTableElement;
use P\Element;
use P\HTMLTableRowElement;
use P\HTMLDivElement;



$div = p("<div><p><div> <span class='def abc'>abc</span><div>inner div</div></div> </p> <p> <div class='abc'>xxx</div></p></div>")[0];

$div->querySelectorAll("span.abc.def[name='test'][name1='test2']");
exit();

foreach ($div->querySelectorAll("span.abc[name='test']") as $p) {
    print_r((string)$p);
    echo "\n";
}


return;
$div = new HTMLDivElement();
$div->textContent = "abc";

echo (string)$div;
return;


$row = new HTMLTableRowElement();
$cell = $row->insertCell();
$cell->textContent = "cell content";
echo (string)$cell;
return;

$t1 = new HTMLTableElement();

$t2 = new HTMLTableElement();
$t2->createTFoot();


$t1->tFoot = $t2->tFoot;


echo $t1->outerHTML;
echo "\n";
echo $t2->outerHTML;
echo "\n";


return;
$div = new Element("div");

$p = new Element("p");
$div->appendChild($p);
print_r($div->children);





return;
$html = <<<HTML
<div class="container"><div class="hello">Hello</div><div class="goodbye">Goodbye</div></div>
HTML;

$p = new P\DOMParser($html);
$e = $p->nodes[0];

print_r($e->innerHTML);

die();





$p = p($html);
$p->empty();
print_r($p[0]->outerHTML);
