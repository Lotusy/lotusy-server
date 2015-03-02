<?php
class CreateDishHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = Utility::getJsonRequestData();

		$validator = new CreateDishValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$profile = Utility::getCurrentUserProfile();

		$verified = ($profile['status']=='success') ? $profile['superuser'] : 'N';

		$dish = new DishDao();
		$dish->setBusinessId($params['businessid']);
		$dish->setNameEn(isset($json['name_en']) ? $json['name_en'] : '');
		$dish->setNameTw(isset($json['name_tw']) ? $json['name_tw'] : '');
		$dish->setNameZh(isset($json['name_zh']) ? $json['name_zh'] : '');
		$dish->setUserId($this->getUserId());
		$dish->setVerified($verified);

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