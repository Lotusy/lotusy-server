<?php
class GetBusinessProfileHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$businessId = $params['businessid'];

		Logger::info('Retrieving Business with id - '.$businessId);

		$business = new BusinessDao($businessId);

		if (!$business->isFromDatabase()) {
			header('HTTP/1.0 404 Not Found');
			$response = array();
			$response['status'] = 'error';
			$response['description'] = 'business_not_found';

			Logger::info('Cannot find business ');

			return $response;
		}

		$response = $business->var;
		unset($response[BusinessDao::IDCOLUMN]);

		Logger::info(json_encode($response));

		$response['status'] = 'success';

		return $response;
	}

}
?>