<?php
class BusinessImageUploadTest extends TestCase {

	const PATH = '/business/:businessid';

	public function run($input) {
		$path = str_replace(':businessid', $input['businessid'], self::PATH);

		$accessToken = $input['access_token'];

		$image = file_get_contents($input['image']);

		$response = TestRequestor::sendPaymentRequest ( 
						$path, 'POST', $image, array('Authorization: Bearer '.$accessToken) );

		return $response;
	}

	public function validate($result) {
		$valid = $result['status'] == 'success';

		return $valid;
	}

	public function failedAction() {
		echo 'Fails on test case - BusinessImageUploadTest ('.json_encode($this->getResult()).')'.PHP_EOL;
		exit;
	}
}
?>