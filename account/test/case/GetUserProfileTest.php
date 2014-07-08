<?php
class GetUserProfileTest extends TestCase {

	const PATH = '/:userid/profile';

	public function run($input) {
		$accessToken = $input['access_token'];
		$userId = $input['user_id'];

		$path = str_replace(':userid', $userId, self::PATH);

		$response = TestRequestor::sendPaymentRequest ( 
						$path, 'GET', null, array('Authorization: Bearer '.$accessToken) );

		return $response;
	}

	public function validate($result) {
		$valid = $result['status'] == 'success';
		$valid = $valid && !empty($result['id']);
		$valid = $valid && isset($result['external_ref']);
		$valid = $valid && isset($result['username']);
		$valid = $valid && isset($result['nickname']);
		$valid = $valid && isset($result['profile_pic']);
		$valid = $valid && isset($result['description']);
		$valid = $valid && isset($result['superuser']);
		$valid = $valid && isset($result['last_login']);

		return $valid;
	}

	public function failedAction() {
		echo 'Fails on test case - GetCurrentUserProfile ('.json_encode($this->getResult()).')'.PHP_EOL;
		exit;
	}
}
?>