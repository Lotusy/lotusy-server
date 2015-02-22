<?php
class CommentDislikeHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$validator = new CommentLikeValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$comment = $validator->getComment();

		$response = array();
		if ($comment->dislike()) {
			$response['status'] = 'success';
		} else {
			$response['status'] = 'error';
		}

		return $response;
	}
}
?>