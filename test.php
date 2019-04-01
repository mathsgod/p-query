<?
use P\DOMParser;

error_reporting(E_ALL & ~E_NOTICE);

require_once(__DIR__ . "/vendor/autoload.php");


$p1=p("<div>123</div>");
$p2=p("<div>xyz</div>");

$p1->append($p2);


$p2->text("yyy");

echo $p1;