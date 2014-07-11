<?php
class RateBusinessTest extends TestCase {

	const PATH = '/:businessid/rate';

	public function run($input) {
		$path = str_replace(':businessid', $input['id'], self::PATH);
		$body = $input;

		$accessToken = $input['access_token'];

		$response = TestRequestor::sendPaymentRequest ( 
						$path, 'POST', $body, array('Authorization: Bearer '.$accessToken) );

		return $response;
	}

	public function validate($result) {
		$valid = $result['status'] == 'success';
		$valid = $valid && !empty($result['rating']);

		return $valid;
	}

	public function failedAction() {
		echo 'Fails on test case - RateBusinessTest ('.json_encode($this->getResult()).')'.PHP_EOL;
		exit;
	}
}
?>