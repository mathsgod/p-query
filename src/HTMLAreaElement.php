<?php

namespace P;

/**
 * @property string $alt Is a DOMString that reflects the alt HTML attribute, containing alternative text for the element.
 * @property string $coords Is a DOMString that reflects the coords HTML attribute, containing coordinates to define the hot-spot region.
 * @property string $hash Is a USVString containing the fragment identifier (including the leading hash mark (#)), if any, in the referenced URL.
 * @property string $host Is a USVString containing the hostname and port (if it's not the default port) in the referenced URL.
 * @property string $hostname Is a USVString containing the hostname in the referenced URL.
 * @property string $href Is a USVString containing that reflects the href HTML attribute, containing a valid URL of a linked resource.
 * @property string $password Is a USVString containing the password specified before the domain name.
 * @property string $pathname Is a USVString containing the path name component, if any, of the referenced URL.
 * @property string $port Is a USVString containing the port component, if any, of the referenced URL.
 * @property string $protocol Is a USVString containing the protocol component (including trailing colon ':'), of the referenced URL.
 * @property string $rel Is a DOMString that reflects the rel HTML attribute, indicating relationships of the current document to the linked resource.
 * @property string $search Is a USVString containing the search element (including leading question mark '?'), if any, of the referenced URL.
 * @property string $shape Is a DOMString that reflects the shape HTML attribute, indicating the shape of the hot-spot, limited to known values.
 * @property int $tabIndex Is a long containing the element's position in the tabbing order.
 * @property string $target Is a DOMString that reflects the target HTML attribute, indicating the browsing context in which to open the linked resource.
 * @property string $username Is a USVString containing the username specified before the domain name.
 */
class HTMLAreaElement extends HTMLElement
{
    public function __construct()
    {
        parent::__construct("area");
    }

    public function __get($name)
    {
        if (in_array($name, [
            "alt",
            "coords",
            "href",
            "rel",
            "search",
            "shape",
            "tabIndex",
            "target",
        ])) {
            return $this->getAttribute($name);
        }

        if ($name == "hash") {
            return parse_url($this->getAttribute("href"), PHP_URL_FRAGMENT);
        }

        if ($name == "host") {
            return parse_url($this->getAttribute("href"), PHP_URL_HOST);
        }

        if ($name == "hostname") {
            return parse_url($this->getAttribute("href"), PHP_URL_HOST);
        }

        if ($name == "password") {
            return parse_url($this->getAttribute("href"), PHP_URL_PASS);
        }

        if ($name == "pathname") {
            return parse_url($this->getAttribute("href"), PHP_URL_PATH);
        }

        if ($name == "port") {
            return parse_url($this->getAttribute("href"), PHP_URL_PORT);
        }

        if ($name == "protocol") {
            return parse_url($this->getAttribute("href"), PHP_URL_SCHEME);
        }

        if ($name == "username") {
            return parse_url($this->getAttribute("href"), PHP_URL_USER);
        }

        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if (in_array($name, [
            "alt",
            "coords",
            "href",
            "rel",
            "search",
            "shape",
            "tabIndex",
            "target",
        ])) {
            $this->setAttribute($name, $value);
            return;
        }

        if (in_array($name, ["hash", "host", "hostname", "password", "pathname", "port", "protocol", "username"])) {
            //rebuild href
            $href = $this->getAttribute("href");
            $href = parse_url($href);

            if ($name == "hash") {
                $href["fragment"] = $value;
            } elseif ($name == "host") {
                $href["host"] = $value;
            } elseif ($name == "hostname") {
                $href["host"] = $value;
            } elseif ($name == "password") {
                $href["pass"] = $value;
            } elseif ($name == "pathname") {
                $href["path"] = $value;
            } elseif ($name == "port") {
                $href["port"] = $value;
            } elseif ($name == "protocol") {
                $href["scheme"] = $value;
            } elseif ($name == "username") {
                $href["user"] = $value;
            }
            $this->setAttribute("href", http_build_url($href));
            return;
        }
        
        return parent::__set($name, $value);
    }
}
