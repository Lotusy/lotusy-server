<?php
class GetDishKeywordCountHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$dishId = $params['dishid'];
		$language = $params['language'];

		$codes = DishUserKeywordDao::getDishKeywordsCount($dishId);

		$descriptions = ItermDao::getCodeDescriptionArray(array_keys($codes), ItermDao::TYPE_KEYWORD, $language);

		$counts = array();
		foreach ($codes as $code=>$count) {
			$description = $descriptions[$code];
			$counts[$description] = $count;
		}

		$response = array();
		$response['status'] = 'success';
		$response['counts'] = $counts;

		return $response;
	}
}
?>