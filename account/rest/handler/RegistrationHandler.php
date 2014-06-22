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
		$account->var[UserDao::EXTERNALTYPE] = UserDao::$TYPEARRAY[$params['type']];
		$account->var[UserDao::EXTERNALREF] = $json['id'];
		$account->var[UserDao::USERNAME] = $json['username'];
		$account->var[UserDao::NICKNAME] = $json['nickname'];
		$account->var[UserDao::PROFILEPIC] = $json['profile_pic'];

		$atReturn = array();
		if ($account->save()) {
			Logger::info('Create User '.json_encode($account->var));
	
			$accessToken = new AccessTokenDao();
			$accessToken->var[AccessTokenDao::USERID] = $account->var[UserDao::IDCOLUMN];
			$accessToken->save();
			Logger::info('Create Token '.json_encode($accessToken->var));
	
			$atReturn['status'] = 'success';
			$atReturn['user_id'] = $account->var[UserDao::IDCOLUMN];
			$atReturn['access_token'] = $accessToken->var[AccessTokenDao::ACCESSTOKEN];
			$atReturn['refresh_token'] = $accessToken->var[AccessTokenDao::REFRESHTOKEN];
			$atReturn['token_type'] = 'Bearer';
			$atReturn['extires_in'] = $accessToken->var[AccessTokenDao::EXPIRESTIME] - time();
		} else {
			header('HTTP/1.0 500 Internal Server Error');
			$atReturn['status'] = 'error';
			$atReturn['description'] = 'internal_server_error';
		}

		return $atReturn;
	}
}
?>