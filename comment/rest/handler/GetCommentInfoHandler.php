<?php
class GetCommentInfoHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$comment = new CommentDao($params['commentid']);

		if ($comment->isFromDatabase()) {
			$response = $comment->toArray();
			$count = ReplyDao::getReplyCountByCommentId($params['commentid']);

			$request = new GetCommentImageLinksRequest($params['commentid']);
			$links = $request->execute();

			$response['reply_count'] = (int)$count;
			$response['image_links'] = $links;

			$now = strtotime('now');
			$last = strtotime($response['create_time']);
			$response['create_time'] = $now - $last;

			$response['status'] = 'success';
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