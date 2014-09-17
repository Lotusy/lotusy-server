<?php
class CreateBusinessHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = Utility::getJsonRequestData();

		$validator = new CreateDishValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$profile = Utility::getCurrentUserProfile();

		$verified = ($profile['status']=='success') ? $profile['superuser'] : 'N';

		$dish = new DishDao();
		$dish->setBusinessId($json['business_id']);
		$dish->setNameEn($json['name_en']);
		$dish->setNameZh($json['name_zh']);
		$dish->setNameTw($json['name_tw']);
		$dish->setUserId($this->getUserId());
		$business->setVerified($verified);

		$atReturn = array();
		if ($dish->save()) {
			$atReturn = $dish->toArray();
			$atReturn['status'] = 'success';
		} else {
			header('HTTP/1.0 500 Internal Server Error');
			$atReturn['status'] = 'error';
			$atReturn['description'] = 'Internal Server Error';
		}

		return $atReturn;
	}
}
?>