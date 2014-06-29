<?php
class CreateBusinessHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = Utility::getJsonRequestData();

		$validator = new CreateBusinessValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$profile = Utility::getCurrentUserProfile();

		$verified = ($profile['status']=='success') ? $profile['superuser'] : 'N';

		$business = new BusinessDao();
		foreach ($business->var as $key=>$val) {
			if (isset($json[$key])) {
				$business->var[$key] = $json[$key];
			}
		}
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