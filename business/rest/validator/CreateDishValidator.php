<?php
class CreateDishValidator extends Validator {

	public function validate() {
		$json = $this->getObjectToBeValidated();

		$valid = $this->nonEmpty($json, 'missing request body');

		if ($valid) {
			$indexes = array('business_id', 'name_zh', 'name_tw', 'name_en');
			$valid = $this->nonEmptyArrayIndex($indexes, $json);
		}

		return $valid;
	}
}
?>