<?php

if (!function_exists("p")) {
    function p($tag = null): P\Query
    {
        return new P\Query($tag);
    }
}
