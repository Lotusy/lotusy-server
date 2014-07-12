<?php
class DislikeCommentTest extends TestCase {

	const PATH = '/comment/:commentid/dislike';

	public function run($input) {
		$path = str_replace(':commentid', $input['comment_id'], self::PATH);

		$accessToken = $input['access_token'];

		$response = TestRequestor::sendPaymentRequest ( 
						$path, 'PUT', null, array('Authorization: Bearer '.$accessToken) );

		return $response;
	}

	public function validate($result) {
		$valid = $result['status'] == 'success';

		return $valid;
	}

	public function failedAction() {
		echo 'Fails on test case - DislikeCommentTest ('.json_encode($this->getResult()).')'.PHP_EOL;
		exit;
	}
}
?>