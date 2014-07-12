<?php
class CreateReplyTest extends TestCase {

	const PATH = '/:commentid/reply';

	public function run($input) {
		$path = str_replace(':commentid', $input['commentid'], self::PATH);
		$body = $input;

		$accessToken = $input['access_token'];

		$response = TestRequestor::sendPaymentRequest ( 
						$path, 'POST', $body, array('Authorization: Bearer '.$accessToken) );

		return $response;
	}

	public function validate($result) {
		$valid = $result['status'] == 'success';
		$valid = $valid && is_numeric($result['id']);

		return $valid;
	}

	public function failedAction() {
		echo 'Fails on test case - CreateReplyTest ('.json_encode($this->getResult()).')'.PHP_EOL;
		exit;
	}
}
?>