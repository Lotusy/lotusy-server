<?php
class AuthenticationHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$json = $params;
		$json['type'] = UserDao::$TYPEARRAY[$json['type']];

		$validator = new AuthenticationValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$user = $validator->getUser();

		$accessToken = new AccessTokenDao();
		$accessToken->setUserId($user->getId());
		$accessToken->setAccessToken(Utility::generateToken());
		$accessToken->setRefreshToken(Utility::generateToken());
		$accessToken->save();
		Logger::info('Create Token '.json_encode($accessToken->toArray()));

		$atReturn = array();
		$atReturn['status'] = 'success';
		$atReturn['user_id'] = $user->getId();
		$atReturn['access_token'] = $accessToken->getAccessToken();
		$atReturn['refresh_token'] = $accessToken->getRefreshToken();
		$atReturn['token_type'] = 'Bearer';
		$atReturn['expires_in'] = $accessToken->getExpiresTime() - time();

		return $atReturn;
	}
}
?>