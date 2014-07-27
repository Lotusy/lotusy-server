<?php
class GetCurrentUserProfileHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$validator = new GetCurrentUserProfileValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		} 

		$user = new UserDao($validator->getUserId());

		$user->setLastLogin(date('Y-m-d H:i:s'));
		$user->save();

		$response = $user->toArray();
		$response['last_login'] = 0;

		$response['status'] = 'success';

		return $response;
	}
}
?>