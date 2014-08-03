<?php
class UpdateCurrentUserProfileHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = Utility::getJsonRequestData();

		$validator = new UpdateCurrentUserProfileValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$user = new UserDao($validator->getUserId());

		$updated = false;

		if (isset($json['nickname'])) {
			$user->setNickname($json['nickname']); 
			$updated = true;
		}
		if (isset($json['username'])) {
			$user->setUsername($json['username']); 
			$updated = true;
		}
		if (isset($json['profile_pic'])) {
			$user->setProfilePic($json['profile_pic']); 
			$updated = true;
		}
		if (isset($json['description'])) {
			$user->setDescription($json['description']); 
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
			$response = $user->toArray();
			$response['status'] = 'success';
		}

		return $response;
	}
}
?>