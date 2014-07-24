<?php
class CreateCommentHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = Utility::getJsonRequestData();

		$validator = new CreateCommentValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$json['user_id'] = $this->getUserId();

		$comment = new CommentDao();
        $comment->setBusinessId($json['business_id']);
        $comment->setUserId($json['user_id']);
        $comment->setLat($json['lat']);
        $comment->setLng($json['lng']);
        $comment->setMessage($json['message']);

		$response = array();
		if ($comment->save()) {
			$response = $comment->toArray();
			$response['status'] = 'success';
		} else {
			header('HTTP/1.0 500 Internal Server Error');
			$response['status'] = 'error';
			$response['description'] = 'internal_server_error';
		}

		return $response;
	}
}
?>