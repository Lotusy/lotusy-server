<?php
class TokenAuthenticationValidator extends Validator {

	public function validate() {
		$json = $this->getObjectToBeValidated();

		$valid = $this->nonEmpty($json, 'missing request body');
		if ($valid) {
			$indexes = array('access_token');
			$valid = $this->nonEmptyArrayIndex($indexes, $json);
		}

		return $valid;
	}
}
?>