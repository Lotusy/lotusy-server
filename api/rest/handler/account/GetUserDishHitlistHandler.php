<?php
class GetUserDishHitlistHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$json = array_merge($_GET, $params);
		$validator = new GetUserDishHitlistValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$dishIds = DishActivityDao::getHitlistedDishes($params['userid'], $json['start'], $json['size']);

		$dishes = DishDao::getRange($dishIds);
		
		$response = array();
		$response['status'] = 'success';
		$response['dishes'] = array();
		
		foreach ($dishes as $dish) {
			array_push($response['dishes'], $dish->toArray());
		}

		return $response;
	}
}
?>