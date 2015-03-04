<?php
class PostUserAlertHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$userId = $this->getUserId();
		$code = $params['code'];

		if ($params['action']=='add') {
			UserAlertDao::addUserAlert($userId, $code);
		} else if ($params['action']=='remove') {
			UserAlertDao::deleteUserAlert($userId, $code);
		}

		return array('status'=>'success');
	}
}
?>