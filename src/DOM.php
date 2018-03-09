<?php

namespace P;
class DOM {
    public static function stringToDOM($inputString) {
        $newDOM = self::parseString($inputString);

        return $newDOM;
    }

    private static function normaliseString($str) {
        $str = preg_replace("/\r/", " ", $str);
        $str = preg_replace("/\n/", " ", $str);
        return $str;
    }

    private static function deSpace($str) {
        $str = preg_replace("/ /", "", $str);
        return $str;
    }

    private static function processTag($str) {
        $newDOM = new DocumentFragment();

        $space = strpos($str, ' ');

        if ($space === false) {
            $tagName = strtolower($str);
            $newDOM->appendChild(new Element($tagName));
        } else {
            $tagName = strtolower(self::deSpace(substr($str, 0, $space)));
            $str = substr($str, $space + 1);
            $newDOM->appendChild(new Element($tagName));

            while (strlen($str) > 0) {
                $equal = strpos($str, "=");
                if ($equal >= 0) {
                    $attributeName = strtolower(self::deSpace(substr($str, 0, $equal)));
                    $sq = strpos($str, "'");
                    $dq = strpos($str, '"');
                    if ($sq === false && $dq === false) {
                        $quote = 0;
                    } elseif ($sq === false) {
                        $quote = $dq;
                        $q = '"';
                    } elseif ($dq === false) {
                        $quote = $sq;
                        $q = "'";
                    } else {
                        $quote = min($sq, $dq);
                        $q = ($sq < $dq)?"'": '"';
                    }

                    $str = substr($str, $quote + 1);
                    $quote = strpos($str, $q);

                    $attributeValue = self::deEntity(substr($str, 0, $quote));
                    $str = substr($str, $quote + 1);
                    $newDOM->lastChild->setAttribute($attributeName, $attributeValue);
                } else {
                    break;
                }
            }
        }

        return $newDOM;
    }

    private static function findEndTag($innerStr, $str, $lastTag) {
        $funcInnerStr = $innerStr;
        $funcStr = $str;
        $lastTag = strtolower($lastTag);

        $nextClosingTag = strpos($funcStr, '</' . $lastTag . '>');

        $funcInnerStr = $funcInnerStr . substr($funcStr, 0, $nextClosingTag);
        $funcStr = substr($funcStr, $nextClosingTag);

        while (strpos($funcInnerStr, '<' . $lastTag) != - 1) {
            $funcInnerStr = substr($funcInnerStr, strpos($funcInnerStr, '<' . $lastTag));
            $funcInnerStr = substr($funcInnerStr, strpos($funcInnerStr, '>') + 1);

            $funcStr = substr($funcStr, strpos($funcStr, '>') + 1);

            $nextClosingTag = strpos($funcStr, '</' . $lastTag . '>');

            $funcInnerStr = $funcInnerStr . substr($funcStr, 0, $nextClosingTag);

            $funcStr = substr($funcStr, $nextClosingTag);
        }

        return strlen($str) - strlen($funcStr);
    }

    private static function deEntity($str) {
        // erwartet einen String und wandelt Entitäten um
        $str = preg_replace("/&amp;/", "&", $str);
        $str = preg_replace("/&gt;/", ">", $str);
        $str = preg_replace("/&lt;/", "<", $str);
        $str = preg_replace("/&nbsp;/", " ", $str);
        $str = preg_replace("/&quot;/", '"', $str);

        return $str;
    }

    protected static function remove_noise($source, $pattern, $remove_tag = false) {
        $count = preg_match_all($pattern, $source, $matches, PREG_SET_ORDER|PREG_OFFSET_CAPTURE);

        for ($i = $count - 1; $i > - 1; --$i) {
            $key = '___noise___' . sprintf('% 5d', count($this->noise) + 1000);
            $idx = ($remove_tag) ? 0 : 1;
            $this->noise[$key] = $matches[$i][$idx][0];
            $this->doc = substr_replace($this->doc, $key, $matches[$i][$idx][1], strlen($matches[$i][$idx][0]));
        }
        // reset the length of content
        $this->size = strlen($this->doc);
        if ($this->size > 0) {
            $this->char = $this->doc[0];
        }
    }

    private static function parseString($str) {
        $nodes = [];

        // echo "1 $value\n";
        while (strlen($value) > 0) {
            echo "2 $value\n";
            $lowerThan = strpos($value, "<");
            if ($lowerThan === false) {
                $value = html_entity_decode($value);
                $this->appendChild(new Text($value));
                echo "6 $value\n";
                $value = null;
            }

            if ($lowerThan > 0) {
                echo "3 $lowerThan\n";
                $newText = html_entity_decode(substr($value, 0, $lowerThan));
                $this->appendChild(new Text($newText));
                $value = substr($value, $lowerThan);
            }

            echo "2.01 lowerThan $lowerThan\n";

            echo "3.1 $value\n";

            if ($lowerThan === 0) {
                $comment = strpos($value, '<!--');
                echo "3.2 comment $comment\n";

                if ($comment === 0) {
                    $commentEnd = strpos($value, '-->');
                    echo "1.0 commentEnd $commentEnd $value\n";
                    $commentContent = substr($value, 4, $commentEnd - 4);
                    $commentContent = html_entity_decode($commentContent);
                    $this->appendChild(new Comment($commentContent));
                    $value = substr($value, $commentEnd + 3);
                } else {
                    $greaterThan = strpos($value, ">");
                    echo "7 greaterThan $greaterThan\n";
                    if (substr($value, $greaterThan - 1, 1) == "/") {
                        $emptyTagEnd = strpos($value, '/>');
                        $emptyTagContent = substr($value, 1, $emptyTagEnd - 1);
                        $newDOM = $this->__processTag($emptyTagContent);
                        $this->appendChild($newDOM);
                        $value = substr($value, $emptyTagEnd + 2);
                    } else {
                        $normalTagEnd = strpos($value, ">");
                        $normalTagContent = substr($value, 1, $normalTagEnd - 1);

                        $newDOM = $this->__processTag($normalTagContent);
                        echo "7.1 normalTagContent $normalTagContent\n";
                        if ($newDOM->tagName == "!doctype") {
                            $this->appendChild($newDOM);
                            $value = substr($value, $normalTagEnd + 1);
                        } elseif ($newDOM->tagName == "script") {
                            $value = substr($value, $normalTagEnd + 1);
                            $posOfEndTag = strpos($value, "</script>");
                            $newDOM->appendChild(new Text(substr($value, 0, $posOfEndTag)));
                            $value = substr($value, $posOfEndTag + 9);
                            $this->appendChild($newDOM);
                        } elseif ($newDOM->tagName == "style") {
                            $value = substr($value, $normalTagEnd + 1);
                            $posOfEndTag = strpos($value, "</style>");
                            $newDOM->appendChild(new Text(substr($value, 0, $posOfEndTag)));
                            $value = substr($value, $posOfEndTag + 8);
                            $this->appendChild($newDOM);
                        } elseif (in_array($newDOM->tagName, self::$_closed_tag)) {
                            $this->appendChild($newDOM);
                            $value = substr($value, strpos($value, '>') + 1);
                        } else {
                            $value = substr($value, $normalTagEnd + 1);
                            echo "3.5 value $value\n";
                            // check has comment
                            $innerStr = substr($value, 0, strpos($value, '</'));
                            echo "3.6 inner Str $innerStr\n";
                            $value = substr($value, strpos($value, '</'));
                            echo "3.7 value $value\n";
                            if (strpos($innerStr, '<') !== false) {
                                $lastTag = $newDOM->tagName;
                                $posOfEndTag = $this->__findEndTag($innerStr, $value, $lastTag);
                                $innerStr = $innerStr . substr($value, 0, $posOfEndTag);
                                echo "3.8 posOfEndTag $posOfEndTag\n";
                                $value = substr($value, $posOfEndTag);
                            }
                            echo "3.9 value $value\n";
                            $value = substr($value, strpos($value, '>') + 1);
                            echo "4 value $value\n";
                            $newDOM->innerHTML = $innerStr;
                            $this->appendChild($newDOM);
                        }
                    }
                }
            }
        }
        return $nodes;
    }
}

?>