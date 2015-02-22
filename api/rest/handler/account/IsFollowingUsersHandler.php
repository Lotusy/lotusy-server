<?php
class IsFollowingUsersHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$userId = $this->getUserId();
		$followingIds = $params['userids'];

		$followingIds = explode(',', $followingIds);

		$followingIds = FollowingDao::isUserFollowings($userId, $followingIds);

		$response = array('status'=>'success', 'followings'=>$followingIds);

		return $response;
	}
}
?>