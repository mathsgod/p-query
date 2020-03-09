<?php

namespace P;

class AnchorCollection extends Query
{
    public function href($getter)
    {
        foreach ($this as $node) {
            $object = p($node)->data("object");
            p($node)->attr("href", call_user_func($getter, $object));
        }
        return $this;
    }
    public function fancybox()
    {
        foreach ($this as $node) {
            $node->setAttribute("data-fancybox", true);
            $node->setAttribute("data-type", "ajax");
        }
        return $this;
    }
}