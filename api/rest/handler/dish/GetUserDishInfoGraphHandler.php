<?php
class GetUserDishInfoGraphHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$dishId = $params['dishid'];
		$userId = $params['userid'];

		$infograph = DishInfographDao::getUserDishInfograph($dishId, $userId);
		$infograph['dish_id'] = $dishId;

		$response = array();
		$response['status'] = 'success';
		$response['infograph'] = $infograph;

		return $response;
	}
}
?>