<?php
class AccountUtil {
    private $ip, $accessToken;

    public function __construct($accessToken=null) {
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
        $atReturn = array();
        $atReturn['Content-Type'] = 'application/json';
        $atReturn['app-key'] = $app_key;
        $atReturn['LOTUSY_FORWARDED_IP'] = $this->ip;
        if (isset($this->accessToken)) {
            $atReturn['Authorization'] = 'Bearer '.$this->accessToken;
        }

        return $atReturn;
    }
}
?>