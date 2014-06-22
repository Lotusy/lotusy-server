<?php
class GetCommentWithOutMessageHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$comment = new CommentDao($params['commentid']);

		if ($comment->isFromDatabase()) {
			$response = $comment->var;
			$response['status'] = 'success';
			unset($response[CommentDao::MESSAGE]);
		} else {
			header('HTTP/1.0 404 Not Found');
			$response = array();
			$response['status'] = 'error';
			$response['description'] = 'comment_not_found';
		}

		return $response;
	}
}
?>