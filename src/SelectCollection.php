<?

namespace P;
class SelectCollection extends Query {

	public function optGroup($data, $getter) {
		foreach ($this as $select) {
			p($select)->attr("optgroup",$getter);
			foreach ($data as $i => $k) {
				p("optgroup")->attr("index", $i)->attr("label", $k)->appendTo($select);
			}

		}
		return $this;
	}

	public function options($options) {
		foreach ($this as $select) {
			if(is_array( $select->attributes["data-value"])){
				$data_values= $select->attributes["data-value"];
			}else{
				$data_values = explode(",", $select->attributes["data-value"]);	
            }
			
            $select->childNodes = array();
            $options_value=[];
			foreach ($options as $k => $o) {
				if (is_array($o)) {
					$og = p("optgroup")->attr("label", $k)->appendTo(p($select));
					foreach ($o as $opt) {
						$option = p("option")->appendTo($og);
						$option->text($opt);
                        $option->val($opt);

                        if (in_array($opt, $data_values)) {
                            $option->attr("selected", true);
                        }

                        $options_value[]=$opt;
        
                    }
                    
				} else {
					$option = p("option")->appendTo(p($select));
					$option->text($o);
					$option->val($o);

                    if (in_array($o, $data_values)) {
                        $option->attr("selected", true);
                    }

                    $options_value[]=$o;
                }
			}
			foreach (array_diff($data_values, $options_value) as $value) {
				if (!$value)
					continue;

				$option = p("option")->appendTo(p($select));
				$option->text($value);
				$option->val($value);
				$option->attr("selected", true);
			}
		}
		return $this;
	}

	public function ds($datasource, $display_member = null, $value_member = null) {
		foreach ($this as $select) {
			if (!$value_member) {
				$value_member = $select->attributes["data-field"];
			}
			$data_value = $select->attributes["data-value"];

			foreach ($datasource as $key => $o) {
				$option = p("option");
				if (is_object($o)) {
					$option->text(\My\Func::_($display_member)->call($o));
					$option->val((string )\My\Func::_($value_member)->call($o));
				} else {
					$option->text($o);
					$option->val($key);
				}

				if(is_array($data_value)){
					if (in_array($option->val(), $data_value)) {
						$option->attr("selected", true);
					}
				}else{
                    if($option->val()==""){
                        if($option->val()===$data_value){
                            $option->attr("selected", true);
                        }
                    }else{
                        if($option->val()==$data_value){
                            $option->attr("selected", true);
                        }
                    }
				}


				//check optgroup
				if ($optgroup_getter = p($select)->attr("optgroup")) {
					$optgroup_value = \My\Func::_($optgroup_getter)->call($o);
					foreach (p($select)->find("optgroup") as $optgroup) {
						if ($optgroup->attributes["index"] == $optgroup_value) {
							$optgroup->appendChild($option[0]);
						}
					}

				} else {
					p($select)->append($option);
				}


			}
		}


		return $this;
	}


}
