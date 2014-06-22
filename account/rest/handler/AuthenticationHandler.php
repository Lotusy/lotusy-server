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
		$accessToken->var[AccessTokenDao::USERID] = $user->var[UserDao::IDCOLUMN];
		$accessToken->save();
		Logger::info('Create Token '.json_encode($accessToken->var));

		$atReturn = array();
		$atReturn['status'] = 'success';
		$atReturn['user_id'] = $user->var[UserDao::IDCOLUMN];
		$atReturn['access_token'] = $accessToken->var[AccessTokenDao::ACCESSTOKEN];
		$atReturn['refresh_token'] = $accessToken->var[AccessTokenDao::REFRESHTOKEN];
		$atReturn['token_type'] = 'Bearer';
		$atReturn['extires_in'] = $accessToken->var[AccessTokenDao::EXPIRESTIME] - time();

		return $atReturn;
		
	}
}
?>