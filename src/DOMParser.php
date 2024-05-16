<?php

namespace P;

class DOMParser
{
    public function parseFromString(string $str): array
    {

        libxml_use_internal_errors(true);


        $option = 0;
        if (LIBXML_VERSION >= 20621) {
            $option |=  LIBXML_COMPACT;
        }


        if (LIBXML_VERSION >= 20708) {
            $option |= LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD;
        }


        $doc = new Document();
        //$doc->loadHTML(mb_convert_encoding("<div>" . $str . "</div>", 'HTML-ENTITIES', 'UTF-8'), $option);
        $doc->loadHTML(mb_encode_numericentity("<div>" . $str . "</div>", [0x80, 0x10FFFF, 0, ~0], 'UTF-8'), $option);

        $d = Document::Current();

        $nodes = [];
        foreach ($doc->childNodes[0]->childNodes as $n) {
            $nodes[] = $d->importNode($n, true);
        }

        return $nodes;
    }
}
