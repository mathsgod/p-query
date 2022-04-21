![LICENSE](https://img.shields.io/github/license/mathsgod/p-query)

![PHP Composer](https://github.com/mathsgod/p-query/workflows/PHP%20Composer/badge.svg)


## Introduction
PQuery is a PHP library used to control html string by using jQuery liked method.


## Example
```php
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
```

## PQuery supported method
- size
- last
- first
- html
- prepend
- prependTo
- appendTo
- append
- attr
- after
- before
- css
- closest
- data
- addClass
- text
- contents
- children
- find
- remove
- removeAtt
- removeClass
- replaceWith
- required
- each
- val
- filter
- parent
- warp
- warpInner
- toggleClass
- hasClass
- prev
- next
- index


## HTML element style and class
```php
$div = new HTMLDivElement();
$div->classList->add("container");
$div->innerText = "Hello world!";
$div->style->color = "red";

echo $div; //<div class="container" style="color: red">Hello world!</div>
```

## Element.append

### Append an element
```php
$div=new HTMLDivElement();
$p=new HTMLParagraphElement();
$div->append($p);

echo $div; // <div><p></p></div>
```

### Appending text
```php
$div=new HTMLDivElement();
$div->append("Some text");

echo $div; // <div>Some text</div>
```

### Appending an element and text
```php
$div=new HTMLDivElement();
$p=new HTMLParagraphElement();
$div->append("Some text",$p);

echo $div; // <div>Some text<p></p></div>
```
___
created by Raymond Chong
