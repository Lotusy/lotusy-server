<?php
class GetUserDishHitlistValidator extends AccessTokenValidator {

	public function validate() {
		$json = $this->getObjectToBeValidated();
		$valid = $this->nonEmpty($json, 'missing request body');

		if ($valid) {
			$indexes = array('start', 'size');
			$valid = $this->nonEmptyArrayIndex($indexes, $json);
		}

		return $valid;
	}
}
?>