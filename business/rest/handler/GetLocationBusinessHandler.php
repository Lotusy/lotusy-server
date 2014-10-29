<?php
class GetLocationBusinessHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;

		$validator = new GetLocationBusinessValidator($json);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$isMiles = $json['is_miles'] == 'true';
		$ids = BusinessDao::getBusinessIdsWithin( $json['lat'], 
												  $json['lng'], 
												  $json['radius'], 
												  $json['start'], 
												  $json['size'], 
												  $isMiles );
		$response = array();
		$response['status'] = 'success';
		$response['businesses'] = array();
		foreach ($ids as $id) {
			$business = new BusinessDao($id['id']);
			$businessArr = array();
			$businessArr['id'] = $id['id'];
			$businessArr['name_zh'] = $business->getNameZh();
			$businessArr['name_tw'] = $business->getNameTw();
			$businessArr['name_en'] = $business->getNameEn();
			$businessArr['price'] = $business->getPrice();
			$businessArr['cash_only'] = $business->getCashOnly();
			$businessArr['image'] = $business->getImage();

			$businessArr['distance'] = round($id['distance'], 1);

			$request = new GetBusinessCommentCountRequest($id['id']);
			$count = $request->execute();
			$businessArr['comment_count'] = (int)$count;

			$rating = BusinessRatingDao::getBusinessRating($id['id']);
			$businessArr['rating'] = $rating;

			array_push($response['businesses'], $businessArr);
		}

		return $response;
	}
}
?>