<?php
class GetUserDishCommentValidator extends Validator {

	public function validate() {
		$json = $this->getObjectToBeValidated();

		$valid = $this->nonEmpty($json, 'missing request body');

		if ($valid) {
			$indexes = array('user_id', 'dish_id');
			$valid = $this->nonEmptyArrayIndex($indexes, $json);
		}

		return $valid;
	}
}
?>