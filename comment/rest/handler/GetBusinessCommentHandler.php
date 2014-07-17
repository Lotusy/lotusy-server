<?php
class GetBusinessCommentHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;
		$json['business_id'] = $params['businessid'];

		$validator = new GetBusinessCommentValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$comments = CommentDao::getCommentsByBusinessId ( 
						$json['business_id'], $json['start'], $json['size'] );

		$response = array();
		$response['status'] = 'success';
		$response['comments'] = array();

		foreach ($comments as $comment) {
			$commentArr = $comment->toArray();
			$count = ReplyDao::getReplyCountByCommentId($comment->getId());
			$commentArr['reply_count'] = $count;
			array_push($response['comments'], $commentArr);
		}

		return $response;
	}
}
?>