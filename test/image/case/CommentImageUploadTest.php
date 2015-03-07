<?php
class CommentImageUploadTest extends TestCase {

    const PATH = '/comment/:commentid';

    public function run($input) {
        $path = str_replace(':commentid', $input['commentid'], self::PATH);

        $accessToken = $input['access_token'];

        $image = file_get_contents($input['image']);

        $response = TestRequestor::sendPaymentRequest ( 
                        $path, 'POST', $image, array('Authorization: Bearer '.$accessToken) );

        return $response;
    }

    public function validate($result) {
        $valid = $result['status'] == 'success';
        $valid = $valid && is_numeric($result['image_id']);

        return $valid;
    }

    public function failedAction() {
        echo 'Fails on test case - CommentImageUploadTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>