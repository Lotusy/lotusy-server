<?php
class CollectCommentHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$validator = new CollectCommentValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		} 

		$userCollection = new LookupUserCollectDao();
		$userCollection->setCommentId($params['commentid']);
		$userCollection->setUserId($this->getUserId());

		if ($userCollection->save()) {
			$response['status'] = 'success';
		} else {
			header('HTTP/1.0 500 Server Internal Error');
			$response['status'] = 'error';
			$response['description'] = 'cannot_save';
		}

		return $response;
	}
}
?>