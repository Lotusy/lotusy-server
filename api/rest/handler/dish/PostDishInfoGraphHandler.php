<?php
class PostDishInfoGraphHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = Utility::getJsonRequestData();
		$dishId = $params['dishid'];
		$userId = $this->getUserId();

		$validator = new PostDishInfoGraphValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$dao = DishInfographDao::getUserDishInfographDao($dishId, $userId);

		$dao->setUserId($userId);
		$dao->setDishId($dishId);

		if (!empty($json['item_value'])) {
			$dao->setItemValue($json['item_value']);
		}
		if (!empty($json['portion_size'])) {
			$dao->setPortionSize($json['portion_size']);
		}
		if (!empty($json['presentation'])) {
			$dao->setPresentation($json['presentation']);
		}
		if (!empty($json['uniqueness'])) {
			$dao->setUniqueness($json['uniqueness']);
		}

		$result = $dao->save();

		$response = array();
		$response['status'] = 'success';
		$response['result'] = $result;

		return $response;
	}
}
?>