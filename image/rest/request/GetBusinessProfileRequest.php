<?php
class GetBusinessProfileRequest extends RestRequest {

	protected function getUrl() {
		return '';
	}

	protected function getMethod() {
		return 'GET';
	}

	protected function modifyHeader(&$header) {
		global $app_key;
		$headers = apache_request_headers();
		$header['app-key'] = $app_key;
		$header['Content-Type'] = 'application/json';
		$header['Authorization'] = $headers['Authorization'];
	}

	protected function parseResponse($response) {
		Logger::info('GetBusinessProfileRequest - '.$response);
		return json_decode($response, true);
	}
}
?>