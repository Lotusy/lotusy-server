<?php
class Utility {

    public static function getRawRequestData() {
        return file_get_contents('php://input');
    }

    public static function getJsonRequestData() {
        $rawData = file_get_contents('php://input');
        return json_decode($rawData, TRUE);
    }

    public static function getCurrentUserProfile() {
        $headers = apache_request_headers();
        $request = new GetAccountProfileRequest();
        $request->setHeader(array('Authorization' => $headers['Authorization']));
        return $request->execute();
    }

    public static function getClientIp() {
        $head = apache_request_headers();
        $ip = (isset($head['LOTUSY_FORWARDED_IP']) ? $head['LOTUSY_FORWARDED_IP'] : '');

        if (empty($ip)) { 
            $ip = (isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '');
        }
        if (empty($ip)) { 
            $ip = (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '');
        }
        if (empty($ip)) {
            $ip = (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
        }

        return $ip;
    }

    public static function generateToken() {
        $token1 = md5(microtime());
        $token2 = md5(rand());
        $token2 = substr($token2, rand(0, 20), 10);

        return strtoupper($token1.'.'.$token2);
    }

    public static function hashLatLng($lag, $lng) {
//        $request = new GoogleReverseGeocodingRequest($lag, $lng);
//        $response = $request->execute();

        $response = 'British Columbia';

        return abs(crc32($response));
    }

    public static function hashString($str) {
        return abs(crc32($str));
    }
}
?>