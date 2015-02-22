<?php
class GetUserDishCommentHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;
		$json['user_id'] = $params['userid'];
		$json['dish_id'] = $params['dishid'];

		$validator = new GetUserDishCommentValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$commentId = CommentDao::getUserDishComment($params['dishid'], $params['userid']);
		$comment = new CommentDao($commentId);

		if (!$comment->isFromDatabase()) {
			header('HTTP/1.0 404 Not Found');
			$response = array('status'=>'error');
			$response['description'] = 'cannot_find_comment';
			return $response;
		}

		$response = $comment->toArray();
		$response['user_pic_url'] = $base_image_host.'/display/user/'.$comment->getUserId();

		$accessToken = $this->getAccessToken();
		$request = new GetUserNicknamesRequest(array($comment->getUserId()), $accessToken);
		$nicknames = $request->execute();

		$response['user_nickname'] = $nicknames[$comment->getUserId()];

		$now = strtotime('now');
		$last = strtotime($response['create_time']);
		$response['create_time'] = $now - $last;

		$response['status'] = 'success';

		return $response;
	}
}
?>