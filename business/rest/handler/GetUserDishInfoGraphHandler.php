<?php
class GetUserDishInfoGraphHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$dishId = $params['dishid'];
		$userId = $params['userid'];

		$infograph = DishInfographDao::getUserDishInfograph($dishId, $userId);

		$response = array();
		$response['status'] = 'success';
		$response['infograph'] = $infograph;

		return $response;
	}
}
?>