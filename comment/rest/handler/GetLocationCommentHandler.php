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

		$commentIds = array();
		foreach ($comments as $comment) {
			array_push($commentIds, $comment->getId());
		}

		$request = new GetCommentsImageLinksRequest($commentIds, $this->getAccessToken());
		$links = $request->execute();

		$now = strtotime('now');

		foreach ($comments as $distance => $comment) {
			$commentArr = $comment->toArray();
			$count = ReplyDao::getReplyCountByCommentId($comment->getId());

			$commentArr['distance'] = $distance;

			$last = strtotime($commentArr['create_time']);
			$commentArr['create_time'] = $now - $last;

			$commentArr['reply_count'] = $count;
			$commentArr['image_links'] = $links[$comment->getId()];
			array_push($response['comments'], $commentArr);
		}

		return $response;
	}
}
?>