<?php
class CreateCommentTest extends TestCase {

    const PATH = '/comment';

    public function run($input) {
        $path = self::PATH;
        $body = $input;

        $accessToken = $input['access_token'];

        $response = TestRequestor::sendPaymentRequest ( 
                        $path, 'POST', $body, array('Authorization: Bearer '.$accessToken) );

        global $comment_id;
        $comment_id = $response['id'];

        return $response;
    }

    public function validate($result) {
        $valid = $result['status'] == 'success';
        $valid = $valid && is_numeric($result['id']);

        return $valid;
    }

    public function failedAction() {
        echo 'Fails on test case - CreateCommentTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>