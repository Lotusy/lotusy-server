<?php
class GetLocationCommentHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;

		$validator = new GetLocationCommentValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$isMiles = isset($json['is_miles']) ? $json['is_miles'] : false;

		$comments = CommentDao::getCommentsByLocation ( 
			$json['lat'], $json['lng'], $json['radius'], $json['start'], $json['size'], $isMiles );

		$response = array();
		$response['status'] = 'success';
		$response['comments'] = array();

		foreach ($comments as $comment) {
			array_push($response['comments'], $comment->var);
		}

		return $response;
	}
}
?>