<?
error_reporting(E_ALL && ~E_NOTICE);

require_once("vendor/autoload.php");

$document=new P\Document();

$div=$document->createElement("div");

$div->classList->add("a");

echo (string)$div;

return;

$select = p("<select></select>")[0];
$select->setAttribute("data-value", json_encode("2018-01-01"));


$c = new P\SelectCollection();
$c[] = $select;
$c->options([
    "2017-01-01",
    "2018-01-01",
    "2019-01-01"
]);

echo (string)$select;
