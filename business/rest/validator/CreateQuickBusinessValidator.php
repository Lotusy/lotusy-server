<?php
class CreateQuickBusinessValidator extends Validator {

	public function validate() {
		$json = $this->getObjectToBeValidated();

		$valid = $this->nonEmpty($json, 'missing request body');

		if ($valid) {
			$indexes = array('name', 'lat', 'lng');
			$valid = $this->nonEmptyArrayIndex($indexes, $json);
		}

		return $valid;
	}
}
?>