<?php


if (!function_exists("p")) {
    function p($tag = null)
    {
        return new P\Query($tag);
    }
}
