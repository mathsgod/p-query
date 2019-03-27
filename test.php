<?
error_reporting(E_ALL & ~E_NOTICE);

require_once(__DIR__ . "/vendor/autoload.php");
use P\Document;

$d = new Document();
$div = $d->createElement("div");


$div->classList->add("c1");
echo (string)$div;
die();

$div = p("<div class='c1 c2'>abc</div>")[0];
echo $div->classList;
die();
$div->classList->add("abc");
echo (string)$div;
die();



$div = p("<div class='c1 c2'>abc</div>")[0];
$div->classList->add("abc");
echo (string)$div;
die();






die();

echo $div[0];


die();




$p = p("<div><script>var a=1;</script></div>");

echo (string)$p[0];

die();




$doc = new Document();

$str = "<br>abc";
$doc->loadHTML($str, LIBXML_COMPACT  | LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED);


echo $doc->saveHTML();

die();

$d1 = new Document();

$doc = new Document();
$doc->loadHTML($str, LIBXML_COMPACT  | LIBXML_HTML_NODEFDTD);

foreach ($doc->childNodes[0]->childNodes[0]->childNodes as $n) {
    $d1->appendChild($d1->importNode($n, true));
}


echo $d1->saveHTML();



die();


$a = p("<br/>abc");

print_r($a);
die();

$doc = new Document();
$e =  $doc->createElement("div");
$e->innerHTML .= "<br>abc";
$e->innerHTML .= "<br>xyz";

echo $e->innerHTML;
die();

$str = '<div class="container"><div class="hello">Hello</div><div class="goodbye">Goodbye</div></div>';
$doc = new Document();
$doc->loadHTML($str, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
foreach ($doc->childNodes as $n) {
    print_R($n);
}
die();

$p = new Document();
$p->loadHTML("<!--abc-->", LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

print_r($p);
die();

$c = new DOMComment("abc");

print_r($c);

return;

$doc = new Document();

$input = $doc->createElement("input");

$input->name = "test";
echo $input->name;

print_r((string)$input);
//$r = $t->insertRow();

//print_r($div->querySelectorAll("span.abc"));
