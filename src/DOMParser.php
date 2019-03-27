<?php
namespace P;

class DOMParser
{
    public function parseFromString($str){
        $doc=new Document();
        $doc->loadHTML($str, LIBXML_COMPACT  | LIBXML_HTML_NODEFDTD  );
        $d=new Document();
        foreach($doc->childNodes[0]->childNodes[0]->childNodes as $n){
            $d->appendChild($d->importNode($n,true));
        }
        return $d;
    }
}
 