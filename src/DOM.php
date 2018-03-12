<?php

namespace P;
class DOM {
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

}

?>