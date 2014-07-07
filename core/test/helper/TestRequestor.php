<?php
class TestRequestor {

	public static function sendPaymentRequest($path, $method, $body=null, $header=null) {
		global $baseUri;

		$curl = curl_init($baseUri.$path);

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

		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);

		if (isset($body)) {
			curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($body));
		}

		if (empty($header)) {
			$header = TestCase::getDefaultHeader();
		} else {
			$header = array_merge($header, TestCase::getDefaultHeader());
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