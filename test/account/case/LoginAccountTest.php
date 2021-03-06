<?php
class LoginAccountTest extends TestCase {

    const PATH = '/auth/:type/:id';

    public function run($input) {
        $externalRef = $input['external_ref'];
        $type = $input['type'];

        $path = str_replace(':type', $type, self::PATH);
        $path = str_replace(':id', $externalRef, $path);

        $response = TestRequestor::sendPaymentRequest($path, 'GET');

        return $response;
    }

    public function validate($result) {
        $valid = $result['status'] == 'success';
        $valid = $valid && !empty($result['access_token']);
        $valid = $valid && isset($result['refresh_token']);
        $valid = $valid && isset($result['token_type']);
        $valid = $valid && isset($result['expires_in']);

        return $valid;
    }

    public function failedAction() {
        echo 'Fails on test case - LoginAccountTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>