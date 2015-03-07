<?php
class CommentReplyTest extends TestCase {

    const PATH = '/:commentid/replies?start=0&size=10';

    public function run($input) {
        global $comment_id;
        if (empty($comment_id)) {
            $comment_id = $input['commentid'];
        }
        $path = str_replace(':commentid', $comment_id, self::PATH);

        $accessToken = $input['access_token'];

        $response = TestRequestor::sendPaymentRequest ( 
                        $path, 'GET', null, array('Authorization: Bearer '.$accessToken) );

        return $response;
    }

    public function validate($result) {
        $valid = $result['status'] == 'success';
        $valid = $valid && !empty($result['replies']);

        return $valid;
    }

    public function failedAction() {
        echo 'Fails on test case - CommentReplyTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>