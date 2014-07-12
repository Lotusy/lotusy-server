<?php
class LocationCommentTest extends TestCase {

	const PATH = '/location?lat=:lat&lng=:lng&radius=10&is_miles=false&start=0&size=10';

	public function run($input) {
		$path = str_replace(':lat', $input['lat'], self::PATH);
		$path = str_replace(':lng', $input['lng'], $path);

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
		echo 'Fails on test case - LocationCommentTest ('.json_encode($this->getResult()).')'.PHP_EOL;
		exit;
	}
}
?>