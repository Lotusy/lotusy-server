<?php
class CreateReplyTest extends TestCase {

    const PATH = '/:commentid/reply';

    public function run($input) {
        global $comment_id;
        if (empty($comment_id)) {
            $comment_id = $input['commentid'];
        }
        $path = str_replace(':commentid', $comment_id, self::PATH);
        $body = $input;

        $accessToken = $input['access_token'];

        $response = TestRequestor::sendPaymentRequest ( 
                        $path, 'POST', $body, array('Authorization: Bearer '.$accessToken) );

        return $response;
    }

    public function validate($result) {
        $valid = $result['status'] == 'success';

        return $valid;
    }

    public function failedAction() {
        echo 'Fails on test case - CreateReplyTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>