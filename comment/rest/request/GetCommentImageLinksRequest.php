<?php
class GetCommentImageLinksRequest extends RestRequest {

	private $commentId, $accessToken;

	public function __construct($commentId, $accessToken) {
		parent::__construct();
		$this->commentId = $commentId;
		$this->accessToken = $accessToken;
	}

	protected function getUrl() {
		global $base_image_host;
		return $base_image_host.'/rest/comment/'.$this->commentId.'/links';
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
		Logger::info('GetCommentImageLinksRequest - '.$response);

		$response = json_decode($response, true);
		return $response['links'];
	}
}
?>