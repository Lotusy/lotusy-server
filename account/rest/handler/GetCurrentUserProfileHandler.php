<?php
class GetCurrentUserProfileHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$validator = new GetCurrentUserProfileValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		} 

		$user = new UserDao($validator->getUserId());

		$response = $user->toArray();

		$followerCount = FollowerDao::getUserFollowerCount($validator->getUserId());
		$response['follower_count'] = (int)$followerCount;

		$now = strtotime('now');
		$last = strtotime($response['last_login']);
		$response['last_login'] = $now - $last;

		$response['status'] = 'success';

		return $response;
	}
}
?>