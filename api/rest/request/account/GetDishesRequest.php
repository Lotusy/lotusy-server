<?php
class GetDishesRequest extends RestRequest {

	private $dishIdsStr = '';

	public function GetDishesRequest($dishIds) {
		parent::__construct();
		$this->dishIdsStr = ''.array_shift($dishIds);
		foreach ($dishIds as $dishId) {
			$this->dishIdsStr.=','.$dishId;
		}
	}

	protected function getUrl() {
		global $base_business_host;

		return $base_business_host.'/rest/dishes/'.$this->dishIdsStr;
	}

	protected function getMethod() {
		return 'GET';
	}

	protected function modifyHeader(&$header) {
		global $app_key;
		$header['Content-Type'] = 'application/json';
		$header['app-key'] = $app_key;
	}

	protected function parseResponse($response) {
		Logger::info($response);
		$json = json_decode($response, TRUE);

		return $json;
	}
}
?>