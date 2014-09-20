<?php
class GetUserDishCollectionValidator extends AccessTokenValidator {

	public function validate() {
		$valid = $this->nonEmpty($json, 'missing request body');

		if ($valid) {
			$indexes = array('start', 'size');
			$valid = $this->nonEmptyArrayIndex($indexes, $json);
		}

		return $valid;
	}
}
?>