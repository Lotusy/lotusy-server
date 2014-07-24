<?php
class CommentInfoTest extends TestCase {

	const PATH = '/comment/:commentid';

	public function run($input) {
		global $comment_id;
		if (empty($comment_id)) {
			$comment_id = $input['comment_id'];
		}
		$path = str_replace(':commentid', $comment_id, self::PATH);

		$accessToken = $input['access_token'];

		$response = TestRequestor::sendPaymentRequest ( 
						$path, 'GET', null, array('Authorization: Bearer '.$accessToken) );

		return $response;
	}

	public function validate($result) {
		$valid = $result['status'] == 'success';
		$valid = $valid && is_numeric($result['id']);
		$valid = $valid && is_numeric($result['business_id']);
		$valid = $valid && is_numeric($result['lat']);
		$valid = $valid && is_numeric($result['lng']);

		return $valid;
	}

	public function failedAction() {
		echo 'Fails on test case - CommentInfoTest ('.json_encode($this->getResult()).')'.PHP_EOL;
		exit;
	}
}
?>