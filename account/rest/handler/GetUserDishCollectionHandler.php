<?php
class GetUserDishCollectionHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;
		$validator = new GetUserDishCollectionValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$dishIds = DishCollectionDao::getCollectedDishes($userId, $json['start'], $json['size']);

		$response = array();
		$response['status'] = 'success';

		return $response;
	}
}
?>