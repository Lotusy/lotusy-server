<?php
class GetUserDishHitlistHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$json = array_merge($_GET, $params);
		$validator = new GetUserDishHitlistValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$dishIds = DishHitlistDao::getHitlistedDishes($params['userid'], $json['start'], $json['size']);

		$request = new GetDishesRequest($dishIds);
		$response = $request->execute();

		return $response;
	}
}
?>