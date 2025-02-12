<?php


$doc = new DOMDocument();
//$doc->formatOutput = true;
$div = $doc->createElement("div");
$div->textContent = "abc
456";

//echo $doc->saveHTML($div);
$doc->loadHTML("<div></div>");

$new_div=$doc->importNode($div, true);
//$doc->documentElement->appendChild($new_div);

echo $doc->saveHTML($new_div);
/* $n = $doc->createTextNode("abc
456");
 */
//echo $doc->saveHTML();
