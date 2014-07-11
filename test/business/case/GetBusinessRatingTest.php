<?php
class GetBusinessRatingTest extends TestCase {

	const PATH = '/:businessid/rating';

	public function run($input) {
		$path = str_replace(':businessid', $input['id'], self::PATH);

		$accessToken = $input['access_token'];

		$response = TestRequestor::sendPaymentRequest ( 
						$path, 'GET', null, array('Authorization: Bearer '.$accessToken) );

		return $response;
	}

	public function validate($result) {
		$valid = $result['status'] == 'success';
		$valid = $valid && !empty($result['rating']);

		return $valid;
	}

	public function failedAction() {
		echo 'Fails on test case - GetBusinessRatingTest ('.json_encode($this->getResult()).')'.PHP_EOL;
		exit;
	}
}
?>