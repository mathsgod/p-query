<?php

namespace P;

/**
 * @property bool $autoplay A boolean value that reflects the autoplay HTML attribute, indicating whether playback should automatically begin as soon as enough media is available to do so without interruption.
 */
class HTMLMediaElement extends HTMLElement
{
    public function __set($name, $value)
    {
        if ($name == "autoplay") {
            if ($value) {
                $this->setAttribute("autoplay", "");
            } else {
                $this->removeAttribute("autoplay");
            }
        }

        parent::__set($name, $value);
    }
}
