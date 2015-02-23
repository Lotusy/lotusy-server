<?php
class GetCurrentUserProfileRequest extends RestRequest {
	
	protected function getUrl() {
		global $base_account_host;
		return $base_account_host.'/rest/profile';
	}

	protected function getMethod() {
		return 'GET';
	}

	protected function modifyHeader(&$header) {
		global $app_key;
		$headers = apache_request_headers();
		$header['Content-Type'] = 'application/json';
		$header['app-key'] = $app_key;
		$header['Authorization'] = $headers['Authorization'];
	}

	protected function parseResponse($response) {
		return json_decode($response, true);
	}
}
?>