<?php

namespace P;

/**
 * @property bool $autoplay A boolean value that reflects the autoplay HTML attribute, indicating whether playback should automatically begin as soon as enough media is available to do so without interruption.
 * @property bool $controls A boolean value that reflects the controls HTML attribute, indicating whether the browser should show playback controls to the user.
 */
class HTMLMediaElement extends HTMLElement
{
    private const array BOOLEAN_ATTRIBUTES = ["autoplay", "controls"];

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        if (in_array($name, self::BOOLEAN_ATTRIBUTES, true)) {
            if ($value) {
                $this->setAttribute($name, "");
            } else {
                $this->removeAttribute($name);
            }
            return;
        }

        parent::__set($name, $value);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (in_array($name, self::BOOLEAN_ATTRIBUTES, true)) {
            return $this->hasAttribute($name);
        }

        return parent::__get($name);
    }
}
