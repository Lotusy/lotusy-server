<?php
class GetDishKeywordsHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$dishId = $params['dishid'];
		$language = $params['language'];

		$codes = DishKeywordDao::getDishKeywords($dishId);

		if (empty($codes)) {
			$descriptions = ItermDao::getTypeLanguageCodes(ItermDao::TYPE_KEYWORD, $language);
		} else {
			$descriptions = ItermDao::getCodeDescriptionArray($codes, ItermDao::TYPE_KEYWORD, $language);
		}

		$response = array();
		$response['status'] = 'success';
		$response['keywords'] = $descriptions;

		return $response;
	}
}
?>