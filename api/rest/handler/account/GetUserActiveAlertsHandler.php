<?php
class GetUserActiveAlertsHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$userId = $this->getUserId();
		$codes = UserAlertDao::getUserAlertCodes($userId);

		return array('status'=>'success', 'codes'=>$codes);
	}
}
?>