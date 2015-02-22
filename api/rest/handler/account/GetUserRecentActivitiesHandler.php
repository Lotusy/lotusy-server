<?php
class GetUserRecentActivitiesHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;
		$json['user_id'] = $params['userid'];

		$validator = new GetUserRecentActivitiesValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$map = DishActivityDao::getUserRecentDishes($json['user_id'], $json['start'], $json['size']);
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

		$response = array('status'=>'success');

		$response['activities'] = array();
		foreach ($map as $time=>$dishList) {
			$activity = $dishes[$dishList['dish_id']];
			$activity['type'] = ($dishList['list']==DishActivityDao::LIST_COLLECTION) ? 'collection' : 'hitlist';

			$request = new GetUserDishCommentRequest($json['user_id'], $dishList['dish_id']);
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