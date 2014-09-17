<?php
class CreateExternalBusinessValidator extends Validator {

	public function validate() {
		$json = $this->getObjectToBeValidated();

		$valid = $this->nonEmpty($json, 'missing request body');

		if ($valid) {
			$indexes = array('external_id', 'external_type', 'name', 'lat', 'lng');
			$valid = $this->nonEmptyArrayIndex($indexes, $json);
		}

		if ($valid) {
			$valid = LookupBusinessExternalDao::externalIdExist($json['external_id'], $json['external_type']);
			if (!$valid) {
				header('HTTP/1.0 409 Conflict');
				$this->setErrorMessage('external_business_already_exist');
			}
		}

		return $valid;
	}
}
?>