<?php
class GetUserProfileValidator extends AccessTokenValidator {

	private $user = null;

	public function validate() {
		$valid = $this->isAccessTokenValid();

		if ($valid) {
			$json = $this->getObjectToBeValidated();
			$this->user = new UserDao($json['userid']);

			$valid = $this->user->isFromDatabase();
			if (!$valid) {
				header('HTTP/1.0 404 Not Found');
				$this->setErrorMessage('user_not_found');
			}
		}

		return $valid;
	}

	public function getUser() {
		return $this->user;
	}
}
?>