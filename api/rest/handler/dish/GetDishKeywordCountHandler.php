<?php
class GetDishKeywordCountHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$dishId = $params['dishid'];
		$language = $params['language'];

		$codes = DishUserKeywordDao::getDishKeywordsCount($dishId);

		$descriptions = ItermDao::getCodeDescriptionArray(array_keys($codes), ItermDao::TYPE_KEYWORD, $language);

		$userCodes = DishUserKeywordDao::getUserDishKeywords($this->getUserId(), $dishId, $language);

		$keywordUserCount = DishUserKeywordDao::getDishKeywordUserCount($dishId);

		$totalUserCount = DishUserKeywordDao::getDishTotalUserCount($dishId);

		$colorArr = KeywordDao::getAllKeywordsColor();

		$counts = array();
		foreach ($codes as $code=>$count) {
			$element = array();
			$element['code'] = $code;
			$element['color'] = $colorArr[$code];
			$element['description'] = $descriptions[$code];
			$element['count'] = $count;
			$element['selected'] = in_array($code, $userCodes);
			$element['percent'] = number_format(100*$keywordUserCount[$code]/$totalUserCount, 2);
			$counts[] = $element;
		}

		$response = array();
		$response['status'] = 'success';
		$response['counts'] = $counts;

		return $response;
	}
}
?>