<?php
class DisplayUserSignatureImageHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$signatureImageDao = new SignatureImageDao($params['signatureId']);

		if ($signatureImageDao->getId()==0) {
			global $base_host, $dish_image_default;
			header('HTTP/1.0 404 Not Found');
			$filename = $base_host.$dish_image_default;
		} else if ($signatureImageDao->getUserId() != $params['userid']) {
			global $base_host, $dish_image_default;
			header('HTTP/1.0 409 Conflict');
			$filename = $base_host.$dish_image_default;
		} else {
			$path = $dishImage->getPath();
			$name = $dishImage->getName();
			$filename = $path.$name;
		}

    	header('Content-Type: image/png');
		readfile($filename);
	}
}
?>