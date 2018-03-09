<?php

namespace P;
class HTMLSelectElement extends HTMLElement {
    public $required = false;
    public $name = null;

    public function __construct() {
        parent::__construct("select");
    }

    public function __set($name, $value) {
        if ($name == "value") {
        	$options=[];
            foreach($this->childNodes as $node) {
            	if($node instanceof HTMLOptionElement){
            		$options[]=$nodes;
            	}
                if ($node->attributes["value"] == $value) {
                    $node->selected = true;
                } else {
                    if (!$this->attributes["multiple"]) {
                        $node->selected = false;
                    }
                }
            }
        } else {
            parent::__set($name, $value);
        }
    }

    public function add(HTMLOptionElement $item) {
        $this->appendChild($item);
    }
    public function __toString() {
        if ($this->required)$this->attributes["request"] = $this->required;
        if ($this->name)$this->attributes["name"] = $this->name;
        /*        if ($this->value) {
            foreach($this->childNodes as $node) {
                if ($node->value == $this->value) {
                    $node->selected = true;
                } else {
                    $node->selected = false;
                }
            }
        }
*/
        return parent::__toString();
    }
    
	public function item($index){
		return $this->getElementsByTagName("option")[$index];
	}
}