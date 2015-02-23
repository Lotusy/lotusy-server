<?php
class GetAccessTokenInfoRequest extends RestRequest {

	private $accessToken = '';

	public function __construct($accessToken) {
		parent::__construct();
		$this->accessToken = $accessToken;
	}

	protected function getUrl() {
		global $base_account_host;
		return $base_account_host.'/rest/tokeninfo?access_token='.$this->accessToken;
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
		Logger::info('GetAccessTokenInfoRequest - '.$response);

		return json_decode($response, true);
	}

}
?>