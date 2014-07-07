<?php
class RegisterAccount extends TestCase {

	const PATH = '/register/:type';

	public function run($input) {
		$body = $input['user'];
		$type = $input['type'];

		$path = str_replace(':type', $type, self::PATH);

		$response = TestRequestor::sendPaymentRequest($path, 'POST', $body);

		return $response;
	}

	public function validate($result) {
		$valid = $result['status'] == 'success';
		$valid = $valid && isset($result['user_id']);
		$valid = $valid && isset($result['access_token']);
		$valid = $valid && isset($result['refresh_token']);
		$valid = $valid && isset($result['token_type']);
		$valid = $valid && isset($result['expires_in']);

		return $valid;
	}

	public function failedAction() {
		echo 'Fails on test case - RegisterAccount ('.json_encode($this->getResult()).')'.PHP_EOL;
	}
}
?>