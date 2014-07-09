<?php
class BusinessProfileTest extends TestCase {

	const PATH = '/:businessid/profile';

	public function run($input) {
		$path = str_replace(':businessid', $input['id'], self::PATH);

		$accessToken = $input['access_token'];

		$response = TestRequestor::sendPaymentRequest ( 
						$path, 'GET', null, array('Authorization: Bearer '.$accessToken) );

		return $response;
	}

	public function validate($result) {
		$valid = $result['status'] == 'success';
		$valid = $valid && is_numeric($result['id']);
		$valid = $valid && is_numeric($result['lat']);
		$valid = $valid && is_numeric($result['lng']);

		return $valid;
	}

	public function failedAction() {
		echo 'Fails on test case - BusinessProfileTest ('.json_encode($this->getResult()).')'.PHP_EOL;
		exit;
	}
}
?>