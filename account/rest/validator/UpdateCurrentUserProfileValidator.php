<?php
class UpdateCurrentUserProfileValidator extends AccessTokenValidator {

	public function validate() {
		$valid = $this->isAccessTokenValid();

		if ($valid) {
			$json = $this->getObjectToBeValidated();
			$valid = $this->nonEmpty($json, 'missing request body');
		}

		return $valid;
	}
}
?>