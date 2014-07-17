<?php
class GetLocationCommentHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;

		$validator = new GetLocationCommentValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$isMiles = isset($json['is_miles']) ? $json['is_miles']=='true' : false;

		$comments = CommentDao::getCommentsByLocation ( 
			$json['lat'], $json['lng'], $json['radius'], $json['start'], $json['size'], $isMiles );

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