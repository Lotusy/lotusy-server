<?php
class GetFollowingRecentDishesHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;
		$validator = new GetFollowingRecentDishesValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		} 

		$user = new UserDao($this->getUserId());

		$userIds = FollowingDao::getFollowingIds($user->getId(), 0, 100000);

		$map = DishActivityDao::getUsersRecentDishes($userIds, $json['start'], $json['size']);
		$dishIds = array_keys($map['dish_ids']); 

		$dishDaos = DishDao::getRange($dishIds, true);

		unset($map['dish_ids']);

		$dishes = array();
		foreach ($dishDaos as $dishDao) {
			$dishes[$dishDao->getId()] = $dishDao->toArray();
		}

		$users = array();
		foreach ($userIds as $id) {
			$dao = new UserDao($id);
			$users[$id] = $dao->toArray();
		}

		$response = array('status'=>'success');

		$response['activities'] = array();
		foreach ($map as $time=>$userDish) {
			$activity = array();
			$activity['user'] = $users[$userDish['user_id']];
			$activity['dish'] = $dishes[$userDish['dish_id']];
			$activity['type'] = ($userDish['list']==DishActivityDao::LIST_COLLECTION) ? 'collection' : 'hitlist';

			if ($userDish['list']==DishActivityDao::LIST_COLLECTION) {
				$preference = DishUserLikeDao::getUserResponseOnDish($userDish['user_id'], $userDish['dish_id']);
				if (isset($preference)) {
					$activity['like'] = $preference->getIsLike()=='Y' ? true : false;
				}
			}

			$commentDao = CommentDao::getUserDishComment($userDish['dish_id'], $userDish['user_id']);
			if (isset($commentDao)) {
				$activity['comment'] = $commentDao->toArray();
			}

			$now = strtotime('now');
			$activityTime = strtotime($time);
			$time = $now - $activityTime;

			$response['activities'][$time] = $activity;
		}

		return $response;
	}
}
?>