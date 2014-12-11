<?php
class GetUserCommentHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;
		$json['user_id'] = $params['userid'];

		$validator = new GetUserCommentValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$comments = CommentDao::getCommentsByUserId ( 
						$json['user_id'], $json['start'], $json['size'] );

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

		foreach ($comments as $comment) {
			$commentArr = $comment->toArray();
			$commentArr['user_pic_url'] = $base_image_host.'/display/user/'.$comment->getUserId();
			$count = ReplyDao::getReplyCountByCommentId($comment->getId());

			$last = strtotime($commentArr['create_time']);
			$commentArr['create_time'] = $now - $last;

			$commentArr['reply_count'] = (int)$count;
			$commentArr['image_links'] = $links[$comment->getId()];
			array_push($response['comments'], $commentArr);
		}

		return $response;
	}
}
?>