<?php
class CommentReplyTest extends TestCase {

	const PATH = '/:commentid/replies?start=0&size=10';

	public function run($input) {
		$path = str_replace(':commentid', $input['comment_id'], self::PATH);

		$accessToken = $input['access_token'];

		$response = TestRequestor::sendPaymentRequest ( 
						$path, 'GET', null, array('Authorization: Bearer '.$accessToken) );

		return $response;
	}

	public function validate($result) {
		$valid = $result['status'] == 'success';
		$valid = $valid && !empty($replies);

		return $valid;
	}

	public function failedAction() {
		echo 'Fails on test case - CommentReplyTest ('.json_encode($this->getResult()).')'.PHP_EOL;
		exit;
	}
}
?>