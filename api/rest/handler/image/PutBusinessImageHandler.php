<?php
class PutBusinessImageHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $base_host, $base_uri, $business_image_dir;

		$businessDao = new BusinessDao($params['businessid']);

		$atReturn = array();
		if (!$businessDao->isFromDatabase()) {
			header('HTTP/1.0 404 Not Found');
			$atReturn['status'] = 'error';
			$atReturn['description'] = 'business_not_found';
			return $atReturn;
		}

		$fileName = 'business_'.$params['businessid'].'_profile.png';

		$this->saveFile($business_image_dir, $fileName);
		$this->saveBusinessImageDao($params['businessid'], $business_image_dir, $fileName);

		$atReturn['status'] = 'success';

		return $atReturn;
	}

	private function saveFile($path, $name) {
		$imageDate = Utility::getRawRequestData();
		file_put_contents($path.$name, $imageDate);
	}

	private function saveBusinessImageDao($businessId, $path, $name) {
		$businessImage = BusinessImageDao::getImagesByBusinessId($businessId);
		if (!isset($businessImage)) { 
			$businessImage = new BusinessImageDao();
			$businessImage->setBusinessId($businessId);
		}
		$businessImage->setName($name);
		$businessImage->setPath($path);
		$businessImage->save();
	}
}
?>