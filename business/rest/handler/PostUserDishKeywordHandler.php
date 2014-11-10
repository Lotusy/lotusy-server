<?php
class PostUserDishKeywordHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$code = $params['code'];
		$dishId = $params['dishid'];
		$userId = $this->getUserId();

		$dao = new DishUserKeywordDao();
		$dao->setDishId($dishId);
		$dao->setUserId($userId);
		$dao->setKeywordCode($code);
		$result = $dao->save();

		$response = array();
		$response['status'] = 'success';
		$response['result'] = $result;

		return $response;
	}
}
?>