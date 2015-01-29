<?php
class GetDishUserInfoHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$userId = $this->getUserId();
		$dishId = $params['dish_id'];

		$followingIds = FollowingDao::getFollowingIds($userId, 0, 1000);
		$userIds = DishActivityDao::getDishTwoUserCollected($dishId, $followingIds);

		if (!empty($userIds)) {
			$twoUsers = UserDao::getRange($userIds);
		} else {
			$twoUsers = array();
		}

		$response = array();
		$response['status'] = 'success';

		$response['names'] = array();
		foreach ($twoUsers as $user) {
			array_push($response['names'], $user->getNickname());
		}

		$response['count'] = DishActivityDao::getDishUserCount($dishId);

		return $response;
	}
}
?>