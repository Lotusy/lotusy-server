<?php
class GetBusinessRatingHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$validator = new GetBusinessRatingValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$rating = RatingDao::getBusinessRating($params['businessid']);

		$response = array();
		$response['status'] = 'success';
		$response['rating'] = $rating;

		return $response;
	}
}
?>