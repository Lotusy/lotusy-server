<?php
class CreateReplyHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = Utility::getJsonRequestData();

		$json['comment_id'] = $params['commentid'];
		$validator = new CreateReplyValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$reply = new ReplyDao();
		$reply->setUserId($this->getUserId());
		$reply->setCommentId($json['comment_id']);
		$reply->setNickname($json['nickname']);
		$reply->setMessage($json['message']);

		$response = array();
		if ($reply->save()) {
			$response['status'] = 'success';
			$response['reply'] = $reply->var;
		} else {
			header('HTTP/1.0 500 Internal Server Error');
			$response['status'] = 'error';
			$response['description'] = 'internal_server_error';
		}

		return $response;
	}
}
?> 