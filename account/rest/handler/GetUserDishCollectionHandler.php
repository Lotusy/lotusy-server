<?php
class GetUserDishCollectionHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$json = array_merge($_GET, $params);
		$validator = new GetUserDishCollectionValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$dishIds = DishActivityDao::getCollectedDishes($params['userid'], $json['start'], $json['size']);

		$request = new GetDishesRequest($dishIds);
		$response = $request->execute();

		return $response;
	}
}
?>