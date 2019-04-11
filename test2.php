<?

echo "LIBXML_VERSION:" . LIBXML_VERSION . "\n";


$doc = new DOMDocument();
$doc->loadHTML("<html><body><div a='1' b='2'>testing</div></body></html>");

$div = $doc->getElementsByTagName("div")->item(0);


$div2 = $doc->createElement("div");

foreach ($div->attributes as $attr) {
    $div2->appendChild($attr);
}


foreach ($div2->attributes as $attr) {
    print_r($attr);
}
