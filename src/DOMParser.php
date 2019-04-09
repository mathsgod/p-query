<?php
namespace P;

class DOMParser
{
    public function parseFromString($str)
    {
        libxml_use_internal_errors(true);
        $doc = new Document();
        $doc->loadHTML(mb_convert_encoding("<div>" . $str . "</div>", 'HTML-ENTITIES', 'UTF-8'), LIBXML_COMPACT  | LIBXML_HTML_NODEFDTD  | LIBXML_HTML_NOIMPLIED);

        $d = Document::Current();
        $nodes = [];
        foreach ($doc->childNodes[0]->childNodes as $n) {
            $nodes[] = $d->importNode($n, true);
        }

        return $nodes;
    }
}
