<?php
class GetUserNicknamesHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$userIds = $params['userids'];

		$userIds = explode(',', $userIds);

		$userNames = array();
		foreach ($userIds as $userId) {
			$user = new UserDao($userId);
			$userNames[$userId] = $user->getNickname();
		}

		$response = array('status'=>'success');
		$response['nicknames'] = $userNames;

		return $response;
	}
}
?>