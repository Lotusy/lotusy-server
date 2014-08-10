<?php
class GetUserFollowersValidator extends AccessTokenValidator {

	public function validate() {
		$valid = $this->isAccessTokenValid();
		return $valid;
	}
}
?>