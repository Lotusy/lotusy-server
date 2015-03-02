<?php
class PostUserDishKeywordHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = Utility::getJsonRequestData();
		$codes = $json['keyword_codes'];
		$dishId = $params['dishid'];
		$userId = $this->getUserId();

		$result = TRUE;
		foreach ($codes as $code) {
			$dao = new DishUserKeywordDao();
			$dao->setDishId($dishId);
			$dao->setUserId($userId);
			$dao->setKeywordCode($code);
			$result = $result && $dao->save();
		}

		$response = array();
		$response['status'] = 'success';
		$response['result'] = $result;

		return $response;
	}
}
?>