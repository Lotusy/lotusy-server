<?php
class GetAccessTokenInfoTest extends TestCase {

	const PATH = '/tokeninfo?access_token=:access_token';

	public function run($input) {
		$accessToken = $input['access_token'];

		$path = str_replace(':access_token', $accessToken, self::PATH);

		$response = TestRequestor::sendPaymentRequest($path, 'GET');

		return $response;
	}

	public function validate($result) {
		$valid = $result['status'] == 'success';
		$valid = $valid && !empty($result['user_id']);
		$valid = $valid && isset($result['token_type']);
		$valid = $valid && isset($result['refresh_token']);
		$valid = $valid && isset($result['expires_in']);

		return $valid;
	}

	public function failedAction() {
		echo 'Fails on test case - AccessTokenInfo ('.json_encode($this->getResult()).')'.PHP_EOL;
		exit;
	}
}
?>