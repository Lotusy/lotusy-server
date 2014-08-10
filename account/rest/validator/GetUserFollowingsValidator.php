<?php
class GetUserFollowingsValidator extends AccessTokenValidator {

	public function validate() {
		$valid = $this->isAccessTokenValid();
		return $valid;
	}
}
?>