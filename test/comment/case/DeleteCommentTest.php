<?php
class DeleteCommentTest extends TestCase {

    const PATH = '/comment/:commentid';

    public function run($input) {
        global $comment_id;
        if (empty($comment_id)) {
            $comment_id = $input['commentid'];
        }
        $path = str_replace(':commentid', $comment_id, self::PATH);

        $accessToken = $input['access_token'];

        $response = TestRequestor::sendPaymentRequest ( 
                        $path, 'DELETE', null, array('Authorization: Bearer '.$accessToken) );

        return $response;
    }

    public function validate($result) {
        $valid = $result['status'] == 'success';

        return $valid;
    }

    public function failedAction() {
        echo 'Fails on test case - DeleteCommentTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>