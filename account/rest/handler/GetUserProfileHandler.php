<?php
class GetUserProfileHandler extends UnauthorizedRequestHandler {

	public function handle($params) {

		$validator = new GetUserProfileValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$user = $validator->getUser();

		$response = $user->toArray();

		$response['follower_count'] = FollowerDao::getUserFollowerCount($validator->getUserId());

		$now = strtotime('now');
		$last = strtotime($response['last_login']);
		$response['last_login'] = $now - $last;

		$response['status'] = 'success';

		return $response;
	}
}
?>