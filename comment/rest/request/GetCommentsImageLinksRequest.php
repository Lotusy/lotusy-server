<?php
class GetCommentsImageLinksRequest extends RestRequest {

	private $commentIds, $accessToken;

	public function __construct($commentIds, $accessToken) {
		parent::__construct();

		$this->commentIds = array_shift($commentIds);
		foreach ($commentIds as $commentId) {
			$this->commentIds .= ','.$commentId;
		}

		$this->accessToken = $accessToken;
	}

	protected function getUrl() {
		global $base_image_host;
		return $base_image_host.'/rest/comments/'.$this->commentIds.'/links';
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
		Logger::info('GetCommentsImageLinksRequest - '.$response);

		$response = json_decode($response, true);
		return $response['links'];
	}
}
?>