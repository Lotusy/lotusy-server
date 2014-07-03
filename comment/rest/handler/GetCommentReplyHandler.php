<?php
class GetCommentReplyHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;
		$json['comment_id'] = $params['commentid'];

		$validator = new GetCommentReplyValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$replies = ReplyDao::getRepliesByCommentId ( 
				$json['comment_id'], $json['start'], $json['size'] );

		$response = array();
		$response['status'] = 'success';

		$response['replies'] = array();
		foreach ($replies as $reply) {
			array_push($response['replies'], $reply->toArray());
		}

		return $response;
	}
}
?>