<?php

namespace P;

class HTMLVideoElement extends HTMLMediaElement
{
    public function __construct()
    {
        parent::__construct("video");
    }
}
