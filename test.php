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

$div = p("<div><span>a<p>b</p>c</span></div>");
echo $div;
die();
foreach($div[0]->childNodes as $n){
    print_r($n);
}

die();
$p = $div->find("p");

print_r($p);
die();

die();
$o=p("<select a='1' b='2'></select>")[0];
print_r($o->attributes);
die();
echo $o;
die();
$s = p("<select><option value='1'>a</option><option value='2' selected>b</option></select>")[0];


echo $s;


die();




$s = p("select");
$s->prepend("<option></option>");
echo $s;
die();

$a = p("a")->attr("href", $href)->text($label)[0];
$li = p("li")[0];
$li->appendChild($a);
echo $li;

die();
$li = p("li")[0];
$a = p("a")->attr("href", "google.com")->text("google")->appendTo($li);

print_r($li->outerHTML);
die();
$nav = p("nav")[0];
p($nav)->append($li);
echo $nav;
die();


$doc = new Document();
$div = $doc->createElement("div");
$div->innerHTML = "\n一二三\n";



echo $div->outerHTML;
die();



$doc = new Document();
$parent = $doc->createElement("div");



$child =  $doc->createElement("p", "一二三");
$parent->appendChild($child);

//$this->parentNode->insertBefore($nodes, $this->nextSibling);

$span =  $doc->createElement("span");
$parent->insertBefore($span);

$doc->normalize();
$doc->appendChild($parent);
$doc->normalizeDocument();
echo $doc->saveHTML($parent);
die();
echo $parent->outerHTML;

die();
$e =  p("div")[0];
$e->innerHTML .= "<br>一二三";

$e->innerHTML .= "<br>xyz";

echo $e->innerHTML;

echo "\n-----\n";

echo $e;

die();
$doc = new Document();
$doc->appendChild($n = $doc->importNode($e, true));
echo $doc->saveHTML($n);
die();


/*
$doc=new Document();



$str=mb_convert_encoding('<div>一二三</div>', 'HTML-ENTITIES', 'UTF-8');

//echo $str;

$doc->loadHTML($str, LIBXML_COMPACT  | LIBXML_HTML_NODEFDTD  | LIBXML_HTML_NOIMPLIED);

echo $doc->saveHTML($doc->childNodes[0]);
die();
*/
//$div = p("<div></div>")[0];
$doc = Document::Current();
$div = $doc->createElement("div");
$span = p("<span>一二三</span>")[0];

$div->appendChild($span);

echo $div->ownerDocument->saveHTML($div);

exit();

$div->innerHTML = '<a href="javascript:void(0)" is="x-editable" data-mode="inline" data-type="text" data-pk="company" data-url="Config/update">Hostlink</a>';

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
