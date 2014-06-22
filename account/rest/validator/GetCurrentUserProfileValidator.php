<?php
class GetCurrentUserProfileValidator extends AccessTokenValidator {

	public function validate() {
		$valid = $this->isAccessTokenValid();
		return $valid;
	}
}
?>