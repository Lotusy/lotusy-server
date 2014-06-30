<?php
class DeleteCommentHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$comment = new CommentDao($params['commentid']);

		$response = array();
		if ($comment->isFromDatabase()) {
			if ($comment->getUserId()==$this->getUserId()) {
				$comment->delete();
				LookupCommentBusinessDao::deleteLookupDao($comment->getBusinessId(), $params['commentid']);
				LookupCommentUserDao::deleteLookupDao($comment->getUserId(), $params['commentid']);
				LookupCommentLocationDao::deleteLookupDao($comment->getLat(), $comment->getLng(), $params['commentid']);

				$response['status'] = 'success';
			} else {
				header('HTTP/1.0 401 Unauthorized');
				$response['status'] = 'error';
				$response['description'] = 'unauthorized_action';
			}
		} else {
			header('HTTP/1.0 404 Not Found');
			$response['status'] = 'error';
			$response['description'] = 'comment_not_found';
		}

		return $response;
	}
}
?>