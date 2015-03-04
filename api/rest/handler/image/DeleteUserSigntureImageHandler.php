<?php
class DeleteUserSigntureImageHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $image_dir;

		$userId = $this->getUserId();

		$res = SignatureImageDao::deleteUserSignature($userId, $params['signatureid']);

		if ($res) {
			$response = array('status'=>'success');
		} else {
			header('HTTP/1.0 404 Not Found');
			$response = array('status'=>'error', 'description'=>'signature_not_found');
		}

		return $response;
	}
}
?>