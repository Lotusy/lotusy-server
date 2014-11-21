<?php
class GetDishInfoGraphHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$dishId = $params['dishid'];

		$infograph = DishInfographDao::getDishInfograph($dishId);

		$response = array();
		$response['status'] = 'success';
		$response['infograph'] = $infograph;

		return $response;
	}
}
?>