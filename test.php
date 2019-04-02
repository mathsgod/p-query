<?
use P\DOMParser;
use P\Element;
use P\HTMLDivElement;
use P\HTMLSpanElement;
use P\Document;
use Symfony\Component\CssSelector\CssSelectorConverter;

error_reporting(E_ALL & ~E_NOTICE);

require_once(__DIR__ . "/vendor/autoload.php");

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
foreach ($xpath->evaluate($x,$p[0]) as $n) {
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
