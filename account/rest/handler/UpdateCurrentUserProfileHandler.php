<?php
class UpdateCurrentUserProfileHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$json = Utility::getJsonRequestData();

		$validator = new UpdateCurrentUserProfileValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$user = new UserDao($validator->getUserId());

		$updated = false;

		if (isset($json['nick_name'])) {
			$user->var[UserDao::NICKNAME] = $json['nick_name']; 
			$updated = true;
		}
		if (isset($json['username'])) {
			$user->var[UserDao::USERNAME] = $json['username']; 
			$updated = true;
		}
		if (isset($json['profile_pic'])) {
			$user->var[UserDao::PROFILEPIC] = $json['profile_pic']; 
			$updated = true;
		}
		if (isset($json['description'])) {
			$user->var[UserDao::DESCRIPTION] = $json['description']; 
			$updated = true;
		}

		$response = array();
		$response['status'] = 'success';

		if ($updated) {
			if (!$user->save()) {
				header('HTTP/1.0 500 Internal Server Error');
				$response['status'] = 'error';
				$response['description'] = 'internal_server_error';
			}
		}

		if ($response['status']=='success') {
			$response['user'] = $user->var;
		}

		return $response;
	}
}
?>