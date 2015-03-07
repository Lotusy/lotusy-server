<?php
class BusinessImageContentTest extends TestCase {

    const PATH = '/display/business/:businessid';

    public function run($input) {
        $path = str_replace(':businessid', $input['businessid'], self::PATH);

        $response = TestRequestor::sendPaymentRequest($path, 'GET');

        return $response;
    }

    public function validate($result) {
        $valid = strlen($result) > 0;

        return $valid;
    }

    public function failedAction() {
        echo 'Fails on test case - BusinessImageContentTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>