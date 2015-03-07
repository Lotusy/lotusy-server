<?php
class BusinessSDK {

    private $ip, $accessToken;

    public function __construct($accessToken) {
        $this->ip = CommonUtil::getClientIp();
        $this->accessToken = $accessToken;
    }


    /**
     * Enter description here ...
     * @param unknown_type $business
     */
    public function createBusiness($business) {
        global $api_host;
        $path = $api_host.'/business';
        $method = 'POST';
        $header = $this->getHeader();

        $body = $business;

        $response = CommonUtil::sendRequest($path, $method, $header, $body);

        return $response;
    }


    /**
     * Enter description here ...
     */
    private function getHeader() {
        global $app_key;
        return array (
            'Content-Type: application/json', 
            'app-key: '.$app_key,
            'Authorization: Bearer '.$this->accessToken,
            'LOTUSY_FORWARDED_IP: '.$this->ip
        );
    }
}
?>