<?php
class CommonUtil {

	public static function getClientIp() {
		$head = apache_request_headers();

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

	public static function sendRequest($uri, $method, $header, $body=NULL) {
		$curl = curl_init($uri);
	
		if (isset($method)) {
			if ($method=='POST') {
				curl_setopt($curl, CURLOPT_POST, 1);
			}
			elseif ($method=='PUT') {
				curl_setopt($curl, CURLOPT_PUT, 1);
			}
			elseif ($method=='DELETE') {
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
			}
		}

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);

		if (isset($body)) {
			curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($body));
		}

		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

		$response = curl_exec($curl);

		$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		curl_close($curl);

		$response = json_decode($response, TRUE);

		$response['status_code'] = $code;

		if (!isset($response['status'])) { $response['status'] = 'error'; }

		return $response;
	}
}
?>