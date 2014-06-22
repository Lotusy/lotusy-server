<?php
class GetCommentReplyCountHandler extends AuthorizedRequestHandler {

	public function handle($params) {

		$count = ReplyDao::getReplyCountByCommentId($params['commentid']);

		$response['status'] = 'success';
		$response['$count'] = $count;

		return $response;
	}
}
?>