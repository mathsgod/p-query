<?php
error_reporting(E_ALL && ~E_NOTICE);

require_once("vendor/autoload.php");

$p = p('<div class="container">
    <div class="hello">Hello</div>
</div>');

$p->find(".hello")->text("abc");

echo $p; /*output 
<div class="container">
    <div class="hello">abc</div>
</div>
*/
