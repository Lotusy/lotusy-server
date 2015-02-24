<?php
class GetAccountProfileRequest extends RestRequest {

	protected function getUrl() {
		global $base_host;
		return $base_host.'/rest/profile';
	}

	protected function getMethod() {
		return 'GET';
	}

	protected function modifyHeader(&$header) {
		global $app_key;
		$header['Content-Type'] = 'application/json';
		$header['app-key'] = $app_key;
	}

	protected function parseResponse($response) {
		Logger::info('GetAccountProfileRequest - '.$response);

		return json_decode($response, true);
	}

}
?>