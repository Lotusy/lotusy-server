<?php
class BusinessCommentTest extends TestCase {

	const PATH = '/business/:businessid/comments?start=0&size=10';

	public function run($input) {
		$path = str_replace(':businessid', $input['businessid'], self::PATH);

		$accessToken = $input['access_token'];

		$response = TestRequestor::sendPaymentRequest ( 
						$path, 'GET', null, array('Authorization: Bearer '.$accessToken) );

		return $response;
	}

	public function validate($result) {
		$valid = $result['status'] == 'success';
		$valid = $valid && !empty($result['comments']);

		return $valid;
	}

	public function failedAction() {
		echo 'Fails on test case - BusinessCommentTest ('.json_encode($this->getResult()).')'.PHP_EOL;
		exit;
	}
}
?>