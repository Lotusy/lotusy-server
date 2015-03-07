<?php
class CommentImageContentTest extends TestCase {

    const PATH = '/display/comment/:imageid';

    public function run($input) {
        $path = str_replace(':imageid', $input['imageid'], self::PATH);

        $response = TestRequestor::sendPaymentRequest($path, 'GET');

        return $response;
    }

    public function validate($result) {
        $valid = strlen($result) > 0;

        return $valid;
    }

    public function failedAction() {
        echo 'Fails on test case - CommentImageContentTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>