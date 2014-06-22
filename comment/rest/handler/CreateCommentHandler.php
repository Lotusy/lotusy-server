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
		foreach ($comment->var as $key=>$val) {
			if (isset($json[$key])) {
				$comment->var[$key] = $json[$key];
			}
		}

		$response = array();
		if ($comment->save()) {
			$response['status'] = 'success';
			$response['comment_id'] = $comment->var[CommentDao::IDCOLUMN];
		} else {
			header('HTTP/1.0 500 Internal Server Error');
			$response['status'] = 'error';
			$response['description'] = 'internal_server_error';
		}

		return $response;
	}
}
?>