<?php
class GetDishInfoGraphHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$dishId = $params['dishid'];

		$infograph = DishInfographDao::getDishInfograph($dishId);

		$result = array();
		foreach ($infograph as $key=>$value) {
			$result[$key] = round($value);
		}

		$response = array();
		$response['status'] = 'success';
		$response['infograph'] = $result;

		return $response;
	}
}
?>