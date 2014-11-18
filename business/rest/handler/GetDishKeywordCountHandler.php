<?php
class GetDishKeywordCountHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$dishId = $params['dishid'];
		$language = $params['language'];

		$codes = DishUserKeywordDao::getDishKeywordsCount($dishId);

		$descriptions = ItermDao::getCodeDescriptionArray(array_keys($codes), ItermDao::TYPE_KEYWORD, $language);

		$userCodes = DishUserKeywordDao::getUserDishKeywords($this->getUserId(), $dishId, $language);

		$counts = array();
		foreach ($codes as $code=>$count) {
			$element = array();
			$element['code'] = $code;
			$element['description'] = $descriptions[$code];
			$element['count'] = $count;
			$element['selected'] = in_array($code, $userCodes);
		}

		$response = array();
		$response['status'] = 'success';
		$response['counts'] = $counts;

		return $response;
	}
}
?>