<?php
class GetCurrentUserProfileTest extends TestCase {

    const PATH = '/profile';

    public function run($input) {
        $accessToken = $input['access_token'];

        $path = self::PATH;

        $response = TestRequestor::sendPaymentRequest ( 
                        $path, 'GET', null, array('Authorization: Bearer '.$accessToken) );

        return $response;
    }

    public function validate($result) {
        $valid = $result['status'] == 'success';
        $valid = $valid && !empty($result['id']);
        $valid = $valid && isset($result['external_ref']);
        $valid = $valid && isset($result['username']);
        $valid = $valid && isset($result['nickname']);
        $valid = $valid && isset($result['profile_pic']);
        $valid = $valid && isset($result['description']);
        $valid = $valid && isset($result['superuser']);
        $valid = $valid && isset($result['last_login']);

        return $valid;
    }

    public function failedAction() {
        echo 'Fails on test case - GetCurrentUserProfileTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>