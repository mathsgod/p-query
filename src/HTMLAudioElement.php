<?php

namespace P;

class HTMLAudioElement extends HTMLMediaElement
{
    public function __construct()
    {
        parent::__construct("audio");
    }
}
