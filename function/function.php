<?php

if (!function_exists("p")) {
    function p($tag)
    {
        return new P\Query($tag);
    }
}
