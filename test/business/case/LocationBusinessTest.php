<?php
class LocationBusinessTest extends TestCase {

    const PATH = '/location?lat=:lat&lng=:lng&radius=1000&is_miles=false&start=0&size=10';

    public function run($input) {
        $path = str_replace(':lat', $input['lat'], self::PATH);
        $path = str_replace(':lng', $input['lng'], $path);

        $accessToken = $input['access_token'];

        $response = TestRequestor::sendPaymentRequest ( 
                        $path, 'GET', null, array('Authorization: Bearer '.$accessToken) );

        return $response;
    }

    public function validate($result) {
        $valid = $result['status'] == 'success';
        $valid = $valid && !empty($result['businesses']);

        foreach ($result['businesses'] as $business) {
        $valid = $valid && is_numeric($business['distance']);
        }

        return $valid;
    }

    public function failedAction() {
        echo 'Fails on test case - LocationBusinessTest ('.json_encode($this->getResult()).')'.PHP_EOL;
        exit;
    }
}
?>