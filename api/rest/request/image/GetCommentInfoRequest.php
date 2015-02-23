<?php
class GetCommentInfoRequest extends RestRequest {

	protected function getUrl() {
		global $base_comment_host;
	}

	protected function getMethod() {
		return 'GET';
	}

	protected function modifyHeader(&$header) {
		global $app_key;
		$header['app-key'] = $app_key;
		$header['Content-Type'] = 'application/json';		
	}

	protected function parseResponse($response) {
		return json_decode($response, true);
	}
}
?>