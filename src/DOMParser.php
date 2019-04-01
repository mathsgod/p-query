<?php
namespace P;

class DOMParser
{
    public function parseFromString($str){
        $doc=new Document();
        $doc->loadHTML("<div>".$str."</div>", LIBXML_COMPACT  | LIBXML_HTML_NODEFDTD  | LIBXML_HTML_NOIMPLIED);

        $d=Document::Current();
        $nodes=[];
        foreach($doc->childNodes[0]->childNodes as $n){
            $nodes[]=$d->importNode($n,true);
        }

        return $nodes;
    }
}
 