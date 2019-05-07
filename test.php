<?
require_once("vendor/autoload.php");

use P\HTMLOptionElement;

$select = p("<select></select>")[0];


foreach (range(1, 4) as $v) {

    $opt = new HTMLOptionElement();
    $opt->value = $v;
    $opt->textContent = $v;
    $select->add($opt);
}
print_r($select);

foreach($select->childNodes as $node){
    print_r($node);
}
die();

print_r(p($select)->find("option"));
return;
foreach (p($select)->find("option") as $opt) {
    print_r($opt);
    print_r($opt->value);
}
