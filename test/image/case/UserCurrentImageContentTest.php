<?php
class UserCurrentImageContentTest extends TestCase {

    const PATH = '/display/user/:userid';

    public function run($input) {
        $path = str_replace(':userid', $input['userid'], self::PATH);

        $response = TestRequestor::sendPaymentRequest($path, 'GET');

        return $response;
    }

    public function validate($result) {
        $valid = strlen($result) > 0;

        return $valid;
    }

    public function failedAction() {
        echo 'Fails on test case - UserCurrentImageContentTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>