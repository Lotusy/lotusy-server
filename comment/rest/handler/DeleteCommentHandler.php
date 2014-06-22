<?php
class DeleteCommentHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$comment = new CommentDao($params['commentid']);

		$response = array();
		if ($comment->isFromDatabase()) {
			if ($comment->var[CommentDao::USERID]==$this->getUserId()) {
				$comment->delete();
				LookupCommentBusinessDao::deleteLookupDao ( 
					$comment->var[CommentDao::BUSINESSID], $params['commentid'] );

				LookupCommentUserDao::deleteLookupDao ( 
					$comment->var[CommentDao::USERID], $params['commentid'] );

				LookupCommentLocationDao::deleteLookupDao ( 
					$comment->var[CommentDao::LAT], 
					$comment->var[CommentDao::LNG], 
					$params['commentid'] );

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