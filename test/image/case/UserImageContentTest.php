<?php
class UserImageContentTest extends TestCase {

    const PATH = '/display/user/:userid/:imageid';

    public function run($input) {
        $path = str_replace(':userid', $input['userid'], self::PATH);
        $path = str_replace(':imageid', $input['imageid'], $path);

        $response = TestRequestor::sendPaymentRequest($path, 'GET');

        return $response;
    }

    public function validate($result) {
        $valid = strlen($result) > 0;

        return $valid;
    }

    public function failedAction() {
        echo 'Fails on test case - UserImageContentTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>