<?php

namespace P;

/**
 * @property bool $autoplay A boolean value that reflects the autoplay HTML attribute, indicating whether playback should automatically begin as soon as enough media is available to do so without interruption.
 * @property bool $controls A boolean value that reflects the controls HTML attribute, indicating whether the browser should show playback controls to the user.
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

        if ($name == "controls") {
            if ($value) {
                $this->setAttribute("controls", "");
            } else {
                $this->removeAttribute("controls");
            }
        }

        parent::__set($name, $value);
    }

    public function __get($name)
    {
        if ($name == "autoplay") {
            return $this->hasAttribute("autoplay");
        }

        if ($name == "controls") {
            return $this->hasAttribute("controls");
        }

        return parent::__get($name);
    }
}
