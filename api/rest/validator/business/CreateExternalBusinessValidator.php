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
			include_once '../dao/BusinessDao.php';
			$valid = isset(BusinessDao::$TYPEARRAY[$json['external_type']]);

			if (!$valid) {
				header('HTTP/1.0 400 Bad Request');
				$this->setErrorMessage('invalid_external_type'); 
			}
		}

		if ($valid) {
			$valid = !BusinessDao::isExternalIdExist($json['external_id'], $json['external_type']);
			if (!$valid) {
				header('HTTP/1.0 409 Conflict');
				$this->setErrorMessage('external_business_already_exist');
			}
		}
Logger::info('json - '.json_encode($json));
		return $valid;
	}
}
?>