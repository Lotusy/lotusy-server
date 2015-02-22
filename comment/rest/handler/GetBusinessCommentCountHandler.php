<?php
class GetBusinessCommentCountHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;
		$json['business_id'] = $params['businessid'];

		$validator = new GetBusinessCommentCountValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$count = CommentDao::getCommentCountByBusinessId($json['business_id']);

		$response = array();
		$response['status'] = 'success';
		$response['count'] = $count;

		return $response;
	}
}
?>