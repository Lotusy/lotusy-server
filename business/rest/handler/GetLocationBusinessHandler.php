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
			array_push($response['businesses'], $businessArr);
		}

		return $response;
	}
}
?>