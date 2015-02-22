<?php
class GetDishesHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		global $base_image_host;

		$validator = new GetDishesValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$dishes = DishDao::getRange($validator->getDishIds());

		$response = array();
		$response['status'] = 'success';
		$response['dishes'] = array();
		foreach ($dishes as $dish) {
			$dishArr = $dish->toArray(array('create_time'));
			$dishArr['image'] = $base_image_host.'/rest/dish/'.$dishArr['id'].'/default';
			array_push($response['dishes'], $dishArr);
		}

		return $response;
	}
}
?>