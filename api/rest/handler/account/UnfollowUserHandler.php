<?php
class UnfollowUserHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$userId = $this->getUserId();
		$followingId = $params['userid'];

		$res = FollowerDao::removeFollowing($followerId, $userId);

		$response = array();

		if ($res) {
			$response['status'] = 'success';
		} else {
			$response['status'] = 'error';
			$response['description'] = 'cannot_unfollower_user';
		}

		return $response;
	}
}
?>