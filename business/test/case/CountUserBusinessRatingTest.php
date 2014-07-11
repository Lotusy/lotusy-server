<?php
class CountUserBusinessRatingTest extends TestCase {

	const PATH = '/business/:businessid/user/:userid/rating';

	public function run($input) {
		$path = str_replace(':businessid', $input['bid'], self::PATH);
		$path = str_replace(':userid', $input['uid'], $path);

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
		echo 'Fails on test case - CountUserBusinessRatingTest ('.json_encode($this->getResult()).')'.PHP_EOL;
		exit;
	}
}
?>