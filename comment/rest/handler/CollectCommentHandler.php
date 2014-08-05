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
		$userCollection->save();
		$response['status'] = 'success';

		return $response;
	}
}
?>