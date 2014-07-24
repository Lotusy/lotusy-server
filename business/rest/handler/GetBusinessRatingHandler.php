<?php
class GetBusinessRatingHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$validator = new GetBusinessRatingValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$rating = RatingDao::getBusinessRating($params['businessid']);

		$now = strtotime('now');
		$last = strtotime($rating['create_time']);
		$rating['create_time'] = $now - $last;

		$response = array();
		$response['status'] = 'success';
		$response['rating'] = $rating;

		return $response;
	}
}
?>