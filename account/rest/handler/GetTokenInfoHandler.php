<?php
class GetTokenInfoHandler extends UnauthorizedRequestHandler {

	public function handle($params) {

		$atReturn = array();
		if (!isset($_GET['access_token'])) {
			header('HTTP/1.0 400 Bad Request');
			$atReturn['status'] = 'error';
			$atReturn['description'] = 'missing_access_token';
			return $atReturn;
		}

		$token = AccessTokenDao::retriveDaoByAccessToken($_GET['access_token']);

		if (!$token->isFromDatabase()) {
			header('HTTP/1.0 404 Not Found');
			$atReturn['status'] = 'error';
			$atReturn['description'] = 'access_token_not_found';
			return $atReturn;
		}

		$atReturn['status'] = 'success';
		$atReturn['user_id'] = $token->var[AccessTokenDao::USERID];
		$atReturn['refresh_token'] = $token->var[AccessTokenDao::REFRESHTOKEN];
		$atReturn['token_type'] = 'Bearer';
		$atReturn['expires_in'] = $token->var[AccessTokenDao::EXPIRESTIME] - time();

		return $atReturn;
	}
}
?>