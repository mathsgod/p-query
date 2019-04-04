<?
namespace P;

class SelectCollection extends Query
{

	public function optGroup($data, $getter)
	{
		foreach ($this as $select) {
			p($select)->attr("optgroup", $getter);
			foreach ($data as $i => $k) {
				p("optgroup")->attr("index", $i)->attr("label", $k)->appendTo($select);
			}
		}
		return $this;
	}

	public function options($options)
	{
		foreach ($this as $select) {
			$select->options($options);
		}

		$data_value = $select->attributes["data-value"];
		if ($data_value !== null) {
			$select->value = $data_value;
		}

		return $this;
	}

	public function ds($datasource, $display_member = null, $value_member = null)
	{
		foreach ($this as $select) {
			if (!$value_member) {
				$value_member = $select->getAttribute("data-field");
			}
			$data_value = $select->getAttribute("data-value");

			foreach ($datasource as $key => $o) {
				$option = p("option");
				if (is_object($o)) {
					$option->text(\My\Func::_($display_member)->call($o));
					$option->val((string )\My\Func::_($value_member)->call($o));
				} else {
					$option->text($o);
					$option->val($key);
				}

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
					$optgroup_value = \My\Func::_($optgroup_getter)->call($o);
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


		return $this;
	}
}
