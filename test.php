<?
use P\DOMParser;
use P\Element;
use P\HTMLDivElement;
use P\HTMLSpanElement;
use P\Document;
use Symfony\Component\CssSelector\CssSelectorConverter;
use P\HTMLInputElement;
use P\HTMLFormElement;

error_reporting(E_ALL & ~E_NOTICE);
require_once(__DIR__ . "/vendor/autoload.php");

$div=p("<div></div>")[0];
$div->innerHTML='<a href="javascript:void(0)" is="x-editable" data-mode="inline" data-type="text" data-pk="company" data-url="Config/update">Hostlink</a>';

echo $div;
die();
$p = p("<select></select>")[0];

p($p)->data("value", ["1", "2", "3"]);
print_r($p);


echo $p;

return;

print_r(HTMLInputElement::ATTRIBUTES);
die();
class AInput extends HTMLInputElement
{
    const ATTRIBUTES = parent::ATTRIBUTES + ["c" => "string"];
}

$f = new AInput();
$f->required = true;
$f->c = "aa";
echo $f;
die();

$s = p("<select><option value='1'>1</option><option value='2'>2</option></select>")[0];

$s->value = 2;

echo $s;

die();

$u = memory_get_usage();
$doc1 = new Document();
$div1 = $doc1->createElement("div", "1");

$div1->setAttribute("is", "hello");
print_r($div1->attributes["is"]);
die();

$doc2 = new Document();
$div2 = $doc2->createElement("div", "2");
$div1->appendChild($doc1->importNode($div2, true));

$div2->value = "3";
echo $div1;
die();
$doc1->registerNodeClass("DOMElement", null);
foreach ($div1->childNodes as $c) {
    print_r($c);
}

echo memory_get_usage() - $u;;


die();
$select = p("select")[0];

$sc = new P\SelectCollection();
$sc[] = $select;
$sc->ds(["a", "b", "c"]);

echo $select;
die();



$p = p("<span><div>123<span>def</span></div></span><div>456</div>");
$p = p("<textarea>123a</textarea>");
/*
foreach($p[0]->childNodes[0]->childNodes as $c){
   print_r($c);
}

die();

*/
$doc = $p[0]->ownerDocument;

$css = new CssSelectorConverter();
$x = $css->toXPath("textarea");
$xpath = new DOMXPath($doc);
foreach ($xpath->evaluate($x, $p[0]) as $n) {
    echo $n->textLength;
    //    print_r($n);
}



die();

$div1 = new HTMLDivElement("hello");
$div2 = new HTMLDivElement("abc");


print_r(p($div1)->find("div"));

die();

$div = new Element("div", "123");
$div1 = new Element("div", "abc");
$div->appendChild($div1);
echo $div;

die();

$p1 = p("<div>123</div>");
$p2 = p("<div>xyz</div>");

$p1->append($p2);


$p2->text("yyy");

echo $p1;
