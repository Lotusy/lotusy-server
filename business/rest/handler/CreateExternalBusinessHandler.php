<?php
class CreateExternalBusinessHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = Utility::getJsonRequestData();

		$validator = new CreateExternalBusinessValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$profile = Utility::getCurrentUserProfile();

		$verified = ($profile['status']=='success') ? $profile['superuser'] : 'N';

		$type = BusinessDao::$TYPEARRAY[$json['external_type']];

		$business = new BusinessDao();
		$business->setExternalId($json['external_id']);
		$business->setExternalType($type);
		$business->setLat($json['lat']);
		$business->setLng($json['lng']);
		$business->setNameEn($json['name']);
		$business->setCategory(empty($json['category']) ? '' : $json['category']);
		$business->setUserId($this->getUserId());
		$business->setVerified($verified);

		$atReturn = array();
		if ($business->save()) {
			$atReturn = $business->toArray();
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