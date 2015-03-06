<?php
class FollowUserHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$validator = new FollowUserValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$following = new FollowerDao();
		$following->setUserId($validator->getUserId());
		$following->setFollowingId($params['userid']);
		$following->save();

		$follower = new FollowerDao();
		$follower->setUserId($params['userid']);
		$follower->setFollowerId($validator->getUserId());
		$follower->save();

		$response = array();
		$response['status'] = 'success';

		return $response;
	}
}
?>