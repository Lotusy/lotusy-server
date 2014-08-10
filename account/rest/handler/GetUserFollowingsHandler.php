<?php
class GetUserFollowingsHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$validator = new GetUserFollowingsValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		} 

		$userIds = FollowingDao::getFollowingIds($params['userid']);

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