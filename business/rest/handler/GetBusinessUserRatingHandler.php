<?php
class GetBusinessUserRatingHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$businessId = $params['businessid'];
		$userId = $params['userid'];

		$rating = RatingDao::getRatingWithBusinessAndUserIds($businessId, $userId);

		$response = array();
		if (!isset($rating)) {
			header('HTTP/1.0 404 Not Found');
			$response['status'] = 'error';
			$response['description'] = 'rating_not_found';
		} else {
			$response['status'] = 'success';
			$response['rating'] = $rating->toArray();
		}

		return $response;
	}
}
?>