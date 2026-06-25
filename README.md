![LICENSE](https://img.shields.io/github/license/mathsgod/p-query)
![PHP Composer](https://github.com/mathsgod/p-query/workflows/PHP%20Composer/badge.svg)
![PHP Version](https://img.shields.io/badge/PHP-8.3%2F8.4%2F8.5-blue)

## Introduction

**PQuery** is a PHP library that lets you parse and manipulate HTML strings using a jQuery-like API. It is built on top of PHP's native DOM extension and uses Symfony's CSS Selector component for selector support.

## Requirements

- PHP ^8.3
- `ext-dom`
- Composer

## Installation

```bash
composer require mathsgod/p-query
```

## Quick Start

```php
require_once("vendor/autoload.php");

$p = p('<div class="container">
    <div class="hello">Hello</div>
</div>');

$p->find(".hello")->text("abc");

echo $p;
/* output
<div class="container">
    <div class="hello">abc</div>
</div>
*/
```

## PQuery Supported Methods

- `size()` / `count()` — number of matched elements
- `first()` / `last()` — get the first or last matched element
- `html()` — get or set inner HTML
- `text()` — get or set text content
- `append()` / `prepend()` — insert content to each element
- `appendTo()` / `prependTo()` — insert elements into target
- `after()` / `before()` — insert content adjacent to elements
- `remove()` — remove elements from the document
- `find()` — search descendants by CSS selector
- `closest()` / `parent()` / `children()` / `contents()` — traverse the DOM
- `attr()` / `removeAttr()` — get or set attributes
- `addClass()` / `removeClass()` / `toggleClass()` / `hasClass()` — class manipulation
- `css()` — get or set inline styles
- `data()` — get or set data attributes
- `val()` — get or set form values
- `filter()` — reduce the matched set
- `each()` — iterate over matched elements
- `replaceWith()` / `wrap()` / `wrapInner()` — replace or wrap elements
- `prev()` / `next()` / `index()` — sibling and position helpers
- `on()` / `trigger()` — event listener helpers

## CSS Selector Support

Use any valid CSS selector with `find()` and `filter()`:

```php
$p = p('<ul>
    <li class="active">One</li>
    <li>Two</li>
    <li id="last">Three</li>
</ul>');

$p->find("li.active")->text("First");
$p->find("#last")->text("Last");
$p->find("li:nth-child(2)")->text("Middle");

echo $p;
```

## Working with HTML Elements

Create and style elements directly:

```php
$div = new HTMLDivElement();
$div->classList->add("container");
$div->innerText = "Hello world!";
$div->style->color = "red";

echo $div; // <div class="container" style="color: red">Hello world!</div>
```

### Append an element

```php
$div = new HTMLDivElement();
$p = new HTMLParagraphElement();
$div->append($p);

echo $div; // <div><p></p></div>
```

### Append text

```php
$div = new HTMLDivElement();
$div->append("Some text");

echo $div; // <div>Some text</div>
```

### Append an element and text

```php
$div = new HTMLDivElement();
$p = new HTMLParagraphElement();
$div->append("Some text", $p);

echo $div; // <div>Some text<p></p></div>
```

## Parse HTML from a File

```php
$p = P\Query::ParseFile("path/to/file.html");
echo $p->find("title")->text();
```

## Events

Attach and trigger event listeners on elements:

```php
$p = p('<button>Click me</button>');
$p->on("click", function (P\Event $e) {
    echo "Clicked!";
});
$p->trigger("click");
```

## Running Tests

```bash
composer install
composer test
```

Tests are run automatically on GitHub Actions against PHP 8.3, 8.4, and 8.5.

## License

MIT

___
Created by Raymond Chong
