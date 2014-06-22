<?php
class CreateBusinessValidator extends Validator {

	public function validate() {
		$json = $this->getObjectToBeValidated();

		$valid = $this->nonEmpty($json, 'missing request body');

		if ($valid) {
			$indexes = array('street', 'city', 'state', 'country', 'lat', 'lng');
			$valid = $this->nonEmptyArrayIndex($indexes, $json);
		}

		if ($valid) {
			$valid = (!empty($json['name_zh']) || !empty($json['name_tw']) || !empty($json['name_en']));
			if (!$valid) {
				header('HTTP/1.0 400 Bad Request');
				$this->setErrorMessage('missing_name');
			}
		}

		return $valid;
	}
}
?>