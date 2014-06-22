<?php
class PostBusinessRatingHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = Utility::getJsonRequestData();
		$json['business_id'] = $params['businessid'];

		$validator = new PostBusinessRatingValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$userId = $this->getUserId();

		$rating = new RatingDao();
		$rating->var[RatingDao::BUSINESSID] = $json['business_id'];
		$rating->var[RatingDao::USERID] = $userId;
		$rating->var[RatingDao::FOOD] = $json['food'];
		$rating->var[RatingDao::SERV] = $json['serv'];
		$rating->var[RatingDao::ENV] = $json['env'];
		$rating->var[RatingDao::OVERALL] = $json['overall'];

		$response = array();
		if (!$rating->save()) {
			$response['status'] = 'error';
			header('HTTP/1.0 500 Internal Server Error');
			$response['description'] = 'internal_server_error';
		} else {
			$response['status'] = 'success';
			$response['rating'] = $rating->var;
		}

		return $response;
	}
}
?>