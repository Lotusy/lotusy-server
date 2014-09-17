<?php
class GetBusinessDishesHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		global $base_image_host;
		$dishes = DishDao::getBusinessDishes($params['businessid']);

		$response = array();
		$response['status'] = 'success';
		$response['dishes'] = array();
		foreach ($dishes as $dish) {
			$dishArr = $dish->toArray('create_time');
			$dishArr['image'] = $base_image_host.'/rest/dish/'.$dishArr['id'].'/default';
			array_push($response['dishes'], $dishArr);
		}

		return $response;
	}
}
?>