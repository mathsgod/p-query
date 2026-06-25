<?php

declare(strict_types=1);
error_reporting(E_ALL & ~E_WARNING);

use PHPUnit\Framework\TestCase;
use P\Comment;

final class CommentTest extends TestCase
{
    public function test_toString()
    {
        $comment = new Comment("hello world");
        $this->assertEquals("<!--hello world-->", (string)$comment);
    }

    public function test_empty_comment()
    {
        $comment = new Comment("");
        $this->assertEquals("<!---->", (string)$comment);
    }

    public function test_textContent()
    {
        $comment = new Comment("initial");
        $comment->textContent = "updated";
        $this->assertEquals("<!--updated-->", (string)$comment);
    }
}
