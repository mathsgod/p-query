<?php

namespace P;

use Closure;

class SelectCollection extends Query
{

	public function prepend($node): Query
	{
		$ret = parent::prepend($node);
		$this->trigger("change");
		return $ret;
	}

	public function optGroup($data, $getter)
	{
		foreach ($this as $select) {
			p($select)->attr("optgroup", $getter);
			foreach ($data as $i => $k) {
				p("optgroup")->attr("index", $i)->attr("label", $k)->appendTo($select);
			}
		}
		$this->trigger("change");
		return $this;
	}

	public function options($options)
	{
		foreach ($this as $select) {
			foreach ($options as $v) {
				$opt = p("<option>")[0];
				$opt->value = $v;
				$opt->textContent = $v;
				$select->add($opt);
			}

			$data_value = json_decode($select->getAttribute("data-value"));

			if ($data_value !== null) {
				if (is_array($data_value)) {
					foreach ($data_value as $v) {
						$select->value = $v;
					}
				} else {
					$select->value = $data_value;
				}
			}
		}


		$this->trigger("change");
		return $this;
	}

	public function ds($datasource, $display_member = null, $value_member = null)
	{
		foreach ($this as $select) {
			if (!$value_member) {
				$value_member = $select->getAttribute("data-field");
			}
			$data_value = json_decode($select->getAttribute("data-value"));

			foreach ($datasource as $key => $o) {
				$option = p("option");

				if ($display_member instanceof Closure) {
					$text = $display_member($o);
				} else {
					if (is_object($o)) {
						$text = $o->{$display_member};
					} elseif (is_array($o)) {
						$text = $o[$display_member];
					}
				}

				$option->text($text);

				if ($value_member instanceof Closure) {
					$value = $value_member($o);
				} else {
					if (is_object($o)) {
						$value = $o->{$value_member};
					} elseif (is_array($o)) {
						$value = $o[$value_member];
					}
				}
				$option->val($value);


				if (is_array($data_value)) {
					if (in_array($option->val(), $data_value)) {
						$option->attr("selected", true);
					}
				} else {
					if ($option->val() == "") {
						if ($option->val() === $data_value) {
							$option->attr("selected", true);
						}
					} else {
						if ($option->val() == $data_value) {
							$option->attr("selected", true);
						}
					}
				}

				//check optgroup
				if ($optgroup_getter = p($select)->attr("optgroup")) {
					if ($optgroup_getter instanceof Closure) {
						$optgroup_value = $optgroup_getter($o);
					} else {
						$optgroup_value = $o->{$optgroup_getter};
					}

					foreach (p($select)->find("optgroup") as $optgroup) {
						if ($optgroup->getAttribute("index") == $optgroup_value) {
							$optgroup->appendChild($option[0]);
						}
					}
				} else {

					p($select)->append($option);
				}
			}
		}

		$this->trigger("change");
		return $this;
	}
}
