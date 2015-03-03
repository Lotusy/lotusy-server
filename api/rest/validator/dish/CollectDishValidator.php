<?php
class CollectDishValidator extends AccessTokenValidator {

	public function validate() {
		$valid = $this->isAccessTokenValid();

		$json = $this->getObjectToBeValidated();

		if ($valid) {
			$indexes = array('userid', 'dishid');
			$valid = $this->nonEmptyArrayIndex($indexes, $json);
		}

		if ($valid) {
			$valid = !DishActivityDao::isDishCollected($json['dishid'], $json['userid']);
			if (!$valid) {
				header('HTTP/1.0 409 Conflict');
				$this->setErrorMessage('dish_already_collected');
			}
		}

		return $valid;
	}
}
?>