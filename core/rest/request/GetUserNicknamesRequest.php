<?php
class GetUserNicknamesRequest extends RestRequest {

	private $userIds;
	private $accessToken;

	public function __construct($userIds, $accessToken) {
		parent::__construct();
		$this->userIds = $userIds;
		$this->accessToken = $accessToken;
	}

	protected function getUrl() {
		global $base_account_host;
		$ids = '';
		foreach ($this->userIds as $userId) {
			$ids.=$userId.',';
		}
		$ids = rtrim($ids, ",");
		return $base_account_host.'/rest/'.$ids.'/nicknames';
	}

	protected function getMethod() {
		return 'GET';
	}

	protected function modifyHeader(&$header) {
		global $app_key;
		$header['Content-Type'] = 'application/json';
		$header['app-key'] = $app_key;
		$header['Authorization'] = 'Bearer '.$this->accessToken;
	}

	protected function parseResponse($response) {
		Logger::info('GetUserNicknamesRequest - '.$response);

		$response = json_decode($response, true);
		return $response['nicknames'];
	}
}
?>