<?php
class GetDishPreferenceDetailHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;

		$dishId = $params['dishid'];
		$userId = $this->getUserId();

		$start = $json['start'];
		$size = $json['size'];

		DishUserLikeDao::getResponsesOnDish($dishId, $start, $size);
	}
}
?>