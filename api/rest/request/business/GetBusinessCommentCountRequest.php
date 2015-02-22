<?php
class GetBusinessCommentCountRequest extends RestRequest {

	private $businessId;

	public function __construct($businessId) {
		parent::__construct();
		$this->businessId = $businessId;
	}

	protected function getUrl() {
		global $base_comment_host;
		return $base_comment_host.'/rest/business/'.$this->businessId.'/comment/count';
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
		Logger::info('GetBusinessCommentCountRequest - '.$response);

		$response = json_decode($response, true);
		return $response['count'];
	}
}
?>