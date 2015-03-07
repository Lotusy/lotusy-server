<?php
class UserImageUploadTest extends TestCase {

    const PATH = '/user';

    public function run($input) {
        $path = self::PATH;

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
        echo 'Fails on test case - UserImageUploadTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>