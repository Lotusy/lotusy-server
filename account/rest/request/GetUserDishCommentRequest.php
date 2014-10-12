<?php
class GetUserDishCommentRequest extends RestRequest {

	private $userId = null;
	private $dishId = null;

	public function GetUserDishCommentRequest($userId, $dishId) {
		parent::__construct();
		$this->userId = $userId;
		$this->dishId = $dishId;
	}

	protected function getUrl() {
		global $base_comment_host;

		return $base_comment_host.'/rest/dish/'.$this->dishId.'/user/'.$this->userId.'/comment';
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
		Logger::info($response);
		$json = json_decode($response, TRUE);

		return $json;
	}
}
?>