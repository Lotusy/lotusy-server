<?php
class CommentImageLinksTest extends TestCase {

    const PATH = '/comment/:commentid/links?start=0&size=10';

    public function run($input) {
        $path = str_replace(':commentid', $input['commentid'], self::PATH);

        $accessToken = $input['access_token'];

        $response = TestRequestor::sendPaymentRequest ( 
                        $path, 'GET', null, array('Authorization: Bearer '.$accessToken) );

        return $response;
    }

    public function validate($result) {
        $valid = $result['status'] == 'success';
        $valid = $valid && !empty($result['links']);

        return $valid;
    }

    public function failedAction() {
        echo 'Fails on test case - CommentImageLinksTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>