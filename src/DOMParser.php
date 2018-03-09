<?php
namespace P;
class DOMParser {
    private static $_closed_tag = ['input', 'hr', 'br', 'img', 'link', 'meta', 'base'];

    public $doc;
    public $nodes = [];
    public $noise = [];

    public function __construct($doc) {
        $this->doc = $doc;
        // strip out cdata
        $this->remove_noise("'<!\[CDATA\[(.*?)\]\]>'is", true);
        // strip out comments
        $this->remove_noise("'<!--(.*?)-->'is");
        // strip out <script> tags
        $this->remove_noise("'<\s*script[^>]*[^/]>(.*?)<\s*/\s*script\s*>'is");
        $this->remove_noise("'<\s*script\s*>(.*?)<\s*/\s*script\s*>'is");
        // strip out <style> tags
        $this->remove_noise("'<\s*style[^>]*[^/]>(.*?)<\s*/\s*style\s*>'is");
        $this->remove_noise("'<\s*style\s*>(.*?)<\s*/\s*style\s*>'is");
        // strip out preformatted tags
        $this->remove_noise("'<\s*(?:code)[^>]*>(.*?)<\s*/\s*(?:code)\s*>'is");
        // strip out server side scripts
        $this->remove_noise("'(<\?)(.*?)(\?>)'s", true);
        // strip smarty scripts
        // $this->remove_noise("'(\{\w)(.*?)(\})'s", true);
        $this->parse();
        $this->restore_noise();
    }

    private function __findEndTag($innerStr, $str, $lastTag) {
        // echo "find End Tag\ninnerStr:$innerStr\n--------------\nstr:$str\n---------\n";
        $funcInnerStr = $innerStr;
        $funcStr = $str;
        $nextClosingTag = strpos($funcStr, "</" . $lastTag);
        // echo "nextClosingTag $nextClosingTag\n-----------\n";
        $funcInnerStr = $funcInnerStr . substr($funcStr, 0, $nextClosingTag);
        // echo "funcInnerStr $funcInnerStr\n-----------\n";
        $funcStr = substr($funcStr, $nextClosingTag);
        // echo "funcStr $funcStr\n-----------\n";
        while (strpos($funcInnerStr, '<' . $lastTag) !== false) {
            $funcInnerStr = substr($funcInnerStr, strpos($funcInnerStr, '<' . $lastTag));
            // echo "1.0funcInnerStr $funcInnerStr\n----\n";
            $funcInnerStr = substr($funcInnerStr, strpos($funcInnerStr, '>') + 1);
            // echo "1.1funcInnerStr $funcInnerStr\n----\n";
            $funcStr = substr($funcStr, strpos($funcStr, '>') + 1);
            // echo "1.11 funcStr $funcStr\n----\n";
            $nextClosingTag = strpos($funcStr, "</" . $lastTag);
            // echo "1.2nextClosingTag $nextClosingTag\n----\n";
            $funcInnerStr = $funcInnerStr . substr($funcStr, 0, $nextClosingTag);
            $funcStr = substr($funcStr, $nextClosingTag);
        }
        // echo "1.91str $str\n----\n";
        // echo "1.92funcStr $funcStr\n----\n";
        // echo "1.99 return " . (strlen($str) - strlen($funcStr)) . "\n---\n";
        return strlen($str) - strlen($funcStr);
    }

    protected function search_noise_node($nodes) {
        $n = [];
        foreach($nodes as $node) {
            if ($node instanceof Text || $node instanceof Comment) {
                $n[] = $node;
            } else {
                foreach($this->search_noise_node($node->childNodes) as $nn) {
                    $n[] = $nn;
                }
            }
        }
        return $n;
    }

    protected function restore_noise() {
        $nodes = $this->search_noise_node($this->nodes);

        foreach($nodes as $n) {
        	if($n->textContent=="")continue;
            if (isset($this->noise[$n->textContent])) {
                $n->textContent = $this->noise[$n->textContent];
            }
        }
    }

    protected function remove_noise($pattern, $remove_tag = false) {
        $count = preg_match_all($pattern, $this->doc, $matches, PREG_SET_ORDER|PREG_OFFSET_CAPTURE);

        for ($i = $count - 1; $i > - 1; --$i) {
            $key = '___noise___' . sprintf('% 5d', count($this->noise) + 1000);
            $idx = ($remove_tag) ? 0 : 1;
            $this->noise[$key] = $matches[$i][$idx][0];
            $this->doc = substr_replace($this->doc, $key, $matches[$i][$idx][1], strlen($matches[$i][$idx][0]));
        }
        return;
    }

    protected function parse() {
        $this->nodes = [];
        $value = $this->doc;
        // echo "1 $value\n";
        while (strlen($value) > 0) {
            // echo "2 $value\n";
            $lowerThan = strpos($value, "<");
            if ($lowerThan === false) {
                $value = html_entity_decode($value);
                $this->nodes[] = new Text($value);
                // echo "6 $value\n";
                $value = null;
            }

            if ($lowerThan > 0) {
                // echo "3 $lowerThan\n";
                $newText = html_entity_decode(substr($value, 0, $lowerThan));
                $this->nodes[] = new Text($newText);
                $value = substr($value, $lowerThan);
            }
            // echo "2.01 lowerThan $lowerThan\n";
            // echo "3.1 $value\n";
            if ($lowerThan === 0) {
                $comment = strpos($value, '<!--');
                // echo "3.2 comment $comment\n";
                if ($comment === 0) {
                    $commentEnd = strpos($value, '-->');
                    // echo "1.0 commentEnd $commentEnd $value\n";
                    $commentContent = substr($value, 4, $commentEnd - 4);
                    $commentContent = html_entity_decode($commentContent);
                    $this->nodes[] = new Comment($commentContent);
                    $value = substr($value, $commentEnd + 3);
                } else {
                    $greaterThan = strpos($value, ">");
                    // echo "7 greaterThan $greaterThan\n";
                    if (substr($value, $greaterThan - 1, 1) == "/") {
                        $emptyTagEnd = strpos($value, '/>');
                        $emptyTagContent = substr($value, 1, $emptyTagEnd - 1);
                        $newDOM = $this->__processTag($emptyTagContent);
                        $this->nodes[] = $newDOM;
                        $value = substr($value, $emptyTagEnd + 2);
                    } else {
                        $normalTagEnd = strpos($value, ">");
                        $normalTagContent = substr($value, 1, $normalTagEnd - 1);

                        $newDOM = $this->__processTag($normalTagContent);
                        // echo "7.1 normalTagContent $normalTagContent\n";
                        if ($newDOM->tagName == "!doctype") {
                            $this->nodes[] = $newDOM;
                            $value = substr($value, $normalTagEnd + 1);
                        } elseif (in_array($newDOM->tagName, self::$_closed_tag)) {
                            $this->nodes[] = $newDOM;
                            $value = substr($value, strpos($value, '>') + 1);
                        } else {
                            $value = substr($value, $normalTagEnd + 1);
                            // echo "3.5 value $value\n------------\n";
                            $innerStr = substr($value, 0, strpos($value, '</'));
                            // echo "3.6 inner Str $innerStr\n------------\n";
                            $value = substr($value, strpos($value, '</'));
                            // echo "3.7 value $value\n------------\n";
                            if (strpos($innerStr, '<') !== false) {
                                $lastTag = $newDOM->tagName;
                                $posOfEndTag = $this->__findEndTag($innerStr, $value, $lastTag);
                                // echo "3.8 posOfEndTag $posOfEndTag , value $value\n";
                                $innerStr = $innerStr . substr($value, 0, $posOfEndTag);
                                // echo "3.85 innerStr $innerStr\n---\n";
                                $value = substr($value, $posOfEndTag);
                                // echo "3.86 value $value\n---\n";
                            }
                            // echo "3.9 value $value\n------------\n";
                            $value = substr($value, strpos($value, '>') + 1);
                            // echo "4 value $value\n------------\n";
                            $newDOM->innerHTML = $innerStr;
                            $this->nodes[] = $newDOM;
                        }
                    }
                }
            }
        }
    }

    private function __processTag($str) {
        // echo "5 $str\n";
        $space = strpos($str, ' ');
        if ($space === false) {
            $newDOM = Document::createElement($str); // new Element($str);
        } else {
            $tagName = substr($str, 0, $space); //should be de space
            $str = substr($str, $space + 1);

            $newDOM = Document::createElement($tagName); // Element($tagName);
            while (strlen($str) > 0) {
                // echo "restart: --{$str}--\n";
                $s = strpbrk($str, " =");
                // echo "strpbrk: --{$s}--\n";
                $attributeName = substr($str, 0, strlen($str) - strlen($s));
                // echo "attribute name : --{$attributeName}--\n";
                // echo "next string: --{$s}--\n";
                if ($s[0] == " ") {
                    // echo "asign attribute name: --{$attributeName}--\n";
                    $newDOM->setAttribute($attributeName, null);
                    $str = substr($s, 1);
                } else {
                    $str = substr($s, 1);
                    // echo "parse attr --{$str}--\n";
                    if ($str[0] != "'" && $str[0] != '"') {
                        // not quote attribute, find next space
                        $val = null;
                        $pos = strpos($str, " ");
                        if ($pos !== false) {
                            $val = substr($str, 0, $pos);
                            $str = substr($str, $pos + 1);
                        }
                        // echo "2.0 --$str--";
                    } else {
                        $q = $str[0];
                        $str = substr($str, 1);
                        $val = "";
                        // echo "2.1 --$str--";
                        do {
                            $pos = strpos($str, $q);
                            $val .= substr($str, 0, $pos);
                            if ($val[strlen($val) - 1] != "\\") {
                                $str = substr($str, $pos + 2);
                                break;
                            }
                            $val = substr($val, 0, - 1) . $q;
                            $str = substr($str, $pos + 2);
                        } while (true);
                    }

                    if ($val === null) {
                        $newDOM->setAttribute($attributeName, null);
                    } else {
                        $val = html_entity_decode($val);
                        if ($attributeName == "class") {
                            foreach(explode(" ", $val) as $class){
                                $newDOM->classList[]=$class;    
                            }
                            
                        } elseif ($attributeName == "style") {
                            $style = explode(";", $val);
                            foreach($style as $s) {
                                if ($s == "")continue;
                                $ss = explode(":", $s, 2);
                                $newDOM->style[trim($ss[0])] = trim($ss[1]);
                            }
                        } else {
                            $newDOM->setAttribute($attributeName, $val);
                        }
                    }
                }
            }

            /*$value = substr($value, $normalTagEnd + 1);
			   $endTagPos = strpos($value, '</');
			   $innerStr = substr($value, 0, $endTagPos);
			   $newDOM->innerHTML = $innerStr;
			   $value = substr($value, strpos($value, '>') + 1);*/
        }
        return $newDOM;
    }
}

?>