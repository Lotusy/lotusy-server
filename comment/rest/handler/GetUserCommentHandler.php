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

		foreach ($comments as $comment) {
			array_push($response['comments'], $comment->toArray());
		}

		return $response;
	}
}
?>