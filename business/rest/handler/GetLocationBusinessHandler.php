<?php
class GetLocationBusinessHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;

		$validator = new GetLocationBusinessValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$isMiles = $json['is_miles'] == 'true';
		$ids = LookupBusinessLocationDao::getBusinessIdsWithin( $json['lat'], 
																$json['lng'], 
																$json['radius'], 
																$json['start'], 
																$json['size'], 
																$isMiles );
		$response = array();
		$response['status'] = 'success';
		$response['businesses'] = array();
		foreach ($ids as $id) {
			$business = new BusinessDao($id['business_id']);
			$businessArr = $business->toArray();

			$businessArr['distance'] = number_format($id['distance'], 3, '.', '');

			$request = new GetBusinessCommentCountRequest($businessId);
			$count = $request->execute();
			$response['comment_count'] = $count;

			$rating = RatingDao::getBusinessRating($id['business_id']);
			$businessArr['rating'] = $rating;
	
			$ratingCount = RatingDao::getBusinessRatingCount($id['business_id']);
			$businessArr['rating_count'] = $ratingCount;

			array_push($response['businesses'], $businessArr);
		}

		return $response;
	}
}
?>