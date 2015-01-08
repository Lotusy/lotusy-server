<?php
class GetFollowingRecentDishesHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;
		$validator = new GetFollowingRecentDishesValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		} 

		$user = new UserDao($validator->getUserId());

		$userIds = FollowingDao::getFollowingIds($user->getId(), 0, 100000);

		$map = DishActivityDao::getUsersRecentDishes($userIds, $json['start'], $json['size']);
		$dishIds = array_keys($map['dish_ids']); 

		$request = new GetDishesRequest($dishIds);
		$response = $request->execute();

		if ($response['status']!='success') {
			$response['status'] = 'error';
			$response['description'] = 'cannot_find_dishes';
			return $response;
		}

		unset($map['dish_ids']);

		$dishes = array();
		foreach ($response['dishes'] as $dish) {
			$dishes[$dish['id']] = $dish;
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

			$request = new GetUserDishCommentRequest($userDish['user_id'], $userDish['dish_id']);
			$commentResponse = $request->execute();
			if ($commentResponse['status']=='success') {
				unset($commentResponse['status']);
				$activity['comment'] = $commentResponse;
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