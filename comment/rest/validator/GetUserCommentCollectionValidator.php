<?php
class GetUserCommentCollectionValidator extends Validator {

	public function validate() {
		$json = $this->getObjectToBeValidated();

		$valid = $this->nonEmpty($json, 'missing request body');

		if ($valid) {
			$indexes = array('user_id', 'start', 'size');
			$valid = $this->nonEmptyArrayIndex($indexes, $json);
		}

		return $valid;
	}
}
?>