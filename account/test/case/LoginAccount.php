<?php
class LoginAccount extends TestCase {

	const PATH = '/auth/:type/:id';

	public function run($input) {
		$userId = $input['user_id'];
		$type = $input['type'];

		$path = str_replace(':type', $type, self::PATH);
		$path = str_replace(':id', $userId, $path);

		$response = TestRequestor::sendPaymentRequest($path, 'GET');

		return $response;
	}

	public function validate($result) {
		$valid = $result['status'] == 'success';
		$valid = $valid && !empty($result['access_token']);
		$valid = $valid && isset($result['refresh_token']);
		$valid = $valid && isset($result['token_type']);
		$valid = $valid && isset($result['expires_in']);

		return $valid;
	}

	public function failedAction() {
		echo 'Fails on test case - LoginAccount ('.json_encode($this->getResult()).')'.PHP_EOL;
	}
}
?>