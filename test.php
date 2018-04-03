<?

require_once(__DIR__."/vendor/autoload.php");

$html=<<<HTML
<div class="container"><div class="hello">Hello</div><div class="goodbye">Goodbye</div></div>
HTML;

$p = new P\DOMParser($html);
$e=$p->nodes[0];

print_r($e->innerHTML);

die();





$p=p($html);
$p->empty();
print_r($p[0]->outerHTML);