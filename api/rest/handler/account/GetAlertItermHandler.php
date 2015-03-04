<?php
class GetAlertItermHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$terms = ItermDao::getTypeLanguageCodes(ItermDao::TYPE_ALERT, $params['language']);

		$response = array();
		$response['status'] = 'success';
		$response['terms'] = $terms;

		return $response;
	}
}
?>