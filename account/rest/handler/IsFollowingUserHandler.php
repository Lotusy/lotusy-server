<?php
class IsFollowingUserHandler extends AuthorizedRequestHandler {
	
	public function handle($params) {
		$userId = $this->getUserId();
		$followingId = $params['userid'];

		$isFollowing = FollowingDao::isUserFollowing($userId, $followingId);

		$response = array('status'=>'success', 'is_following'=>$isFollowing);

		return $response;
	}
}
?>