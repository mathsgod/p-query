<?php

namespace P;

/**
 * @property string $hash Is a USVString representing the fragment identifier, including the leading hash mark ('#'), if any, in the referenced URL.
 * @property string $host Is a USVString representing the hostname and port (if it's not the default port) in the referenced URL.
 * @property string $hostname Is a USVString representing the hostname in the referenced URL.
 * @property string $href Is a USVString that is the result of parsing the href HTML attribute relative to the document, containing a valid URL of a linked resource.
 * @property string $password Is a USVString containing the password specified before the domain name.
 * @property string $pathname Is a USVString containing an initial '/' followed by the path of the URL, not including the query string or fragment.
 * @property string $port Is a USVString representing the port component, if any, of the referenced URL.
 * @property string $protocol Is a USVString representing the protocol component, including trailing colon (':'), of the referenced URL.
 * @property string $rel Is a DOMString that reflects the rel HTML attribute, specifying the relationship of the target object to the linked object.
 * @property DOMTokenList $relList Returns a DOMTokenList that reflects the rel HTML attribute, as a list of tokens.
 * @property string $search Is a USVString representing the search element, including leading question mark ('?'), if any, of the referenced URL.
 * @property string $username Is a USVString containing the username specified before the domain name.
 */
class HTMLAnchorElement extends HTMLElement
{
    public function __construct(string|null $value = null, string $namespace = null)
    {
        parent::__construct("a", $value, $namespace);
    }

    public function __get($name)
    {
        if ($name == "hash") {
            return parse_url($this->getAttribute("href"), PHP_URL_FRAGMENT);
        }
        if ($name == "host") {
            $host = parse_url($this->getAttribute("href"), PHP_URL_HOST);
            $port = parse_url($this->getAttribute("href"), PHP_URL_PORT);
            if ($port) {
                $host .= ":" . $port;
            }
            return $host;
        }

        if ($name == "hostname") {
            return parse_url($this->getAttribute("href"), PHP_URL_HOST);
        }

        if ($name == "href") {
            return $this->getAttribute("href");
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
        if ($name == "rel") {
            return $this->getAttribute("rel");
        }
        if ($name == "relList") {
            return new DOMTokenList($this, "rel");
        }
        if ($name == "search") {
            return parse_url($this->getAttribute("href"), PHP_URL_QUERY);
        }
        if ($name == "username") {
            return parse_url($this->getAttribute("href"), PHP_URL_USER);
        }

        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if ($name == "href") {
            $this->setAttribute("href", $value);
            return;
        }

        if (in_array($name, ["hash", "host", "hostname", "password", "pathname", "port", "protocol", "username"])) {
            //rebuild href
            $href = $this->getAttribute("href");
            $href = parse_url($href);

            if ($name == "hash") {
                $href["fragment"] = $value;
            } elseif ($name == "host") {
                //split host and port
                $host = explode(":", $value);
                $href["host"] = $host[0];
                if (isset($host[1])) {
                    $href["port"] = $host[1];
                }
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

        parent::__set($name, $value);
    }
}
