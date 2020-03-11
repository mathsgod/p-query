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
- closet
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



___
created by Raymond Chong
