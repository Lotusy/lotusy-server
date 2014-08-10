<?php
class GetUserFollowingsHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;
		$json['userid'] = $params['userid'];

		$validator = new GetUserFollowingsValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		} 

		$userIds = FollowingDao::getFollowingIds($params['userid'], $json['start'], $json['size']);

		$response = array();
		$response['status'] = 'success';
		$response['users'] = array();

		foreach ($userIds as $userId) {
			$user = new UserDao($userId);

			$userArr = $user->toArray();

			$now = strtotime('now');
			$last = strtotime($userArr['last_login']);
			$userArr['last_login'] = $now - $last;

			array_push($response['users'], $userArr);
		}

		return $response;
	}
}