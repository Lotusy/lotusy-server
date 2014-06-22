<?php
class GoogleReverseGeocodingRequest extends RestRequest {

	private $lat, $lng;

	public function __construct($lat, $lng) {
		parent::__construct();
		$this->lat = $lat;
		$this->lng = $lng;
	}

	protected function getUrl() {
		return 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$this->lat.','.$this->lng.'&sensor=false';
	}

	protected function getMethod() {
		return 'GET';
	}

	protected function parseResponse($response) {
		$resArr = json_decode($response, true);

		if ($resArr['status']=='OK') {
			$result = reset($resArr['results']);
			$addressComponents = $result['address_components'];
			foreach ($addressComponents as $component) {
				foreach ($component['types'] as $type) {
					if ($type == 'administrative_area_level_1') {
						Logger::info('GoogleReverseGeocodingRequest - ['.$this->lat.','.$this->lng.'] = '.$component['long_name']);
						return $component['long_name'];
					}
				}
			}
			Logger::warn('GoogleReverseGeocodingRequest - ['.$this->lat.','.$this->lng.'] = Result DO NOT have administrative_area_level_1.');
			$atReturn = 'NOT_FOUND';
		} else {
			$atReturn = $resArr['status'];
			Logger::warn('GoogleReverseGeocodingRequest - ['.$this->lat.','.$this->lng.'] = '.$resArr['status']);

			if ($resArr['status']=='OVER_QUERY_LIMIT') {
				usleep(rand(20000, 50000));
				$request = new GoogleReverseGeocodingRequest($this->lat, $this->lng);
				$atReturn = $request->execute();
			}
		}

		return $atReturn;
	}

}
?>