<?php
class GetBusinessProfileImageHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$businessImage = BusinessImageDao::getImagesByBusinessId($params['businessid']);

		if (!isset($businessImage)) {
			global $base_host, $business_image_default;
			header('HTTP/1.0 404 Not Found');
			$filename = $base_host.$business_image_default;
		} else {
			$path = $businessImage->getPath();
			$name = $businessImage->getName();
			$filename = $path.$name;
		}

    	header('Content-Type: image/jpeg');
		readfile($filename);
	}
}
?>