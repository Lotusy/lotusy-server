<?php
class RegistrationHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$json = Utility::getJsonRequestData();
		$json['external_type'] = $params['type'];

		$validator = new RegistrationValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$account = new UserDao();
		$account->setExternalType(UserDao::$TYPEARRAY[$params['type']]);
		$account->setExternalRef($json['id']);
		$account->setUsername($json['username']);
		$account->setNickname($json['nickname']);
		$account->setProfilePic($json['profile_pic']);

		$atReturn = array();
		if ($account->save()) {
			Logger::info('Create User '.json_encode($account->toArray()));

			$accessToken = new AccessTokenDao();
			$accessToken->setUserId($account->getId());
			$accessToken->setAccessToken(Utility::generateToken());
			$accessToken->setRefreshToken(Utility::generateToken());
			$accessToken->save();
			Logger::info('Create Token '.json_encode($accessToken->toArray()));

			$atReturn['status'] = 'success';
			$atReturn['user_id'] = $account->getId();
			$atReturn['access_token'] = $accessToken->getAccessToken();
			$atReturn['refresh_token'] = $accessToken->getRefreshToken();
			$atReturn['token_type'] = 'Bearer';
			$atReturn['expires_in'] = $accessToken->getExpiresTime() - time();
		} else {
			header('HTTP/1.0 500 Internal Server Error');
			$atReturn['status'] = 'error';
			$atReturn['description'] = 'internal_server_error';
		}

		return $atReturn;
	}
}
?>