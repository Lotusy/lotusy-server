<?php
class GetUserProfileHandler extends UnauthorizedRequestHandler {

	public function handle($params) {

		$validator = new GetUserProfileValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$user = $validator->getUser();

		$response = $user->toArray();
		$response['status'] = 'success';

		return $response;
	}
}
?>