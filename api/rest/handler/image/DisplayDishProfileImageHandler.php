<?php
class DisplayDishProfileImageHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$dishImage = DishImageDao::getDishImageById($params['dishid'], $params['imageid']);
		if (!isset($dishImage)) {
			global $base_host, $dish_image_default;
			header('HTTP/1.0 404 Not Found');
			$filename = $base_host.$dish_image_default;
		} else {
			$path = $dishImage->getPath();
			$name = $dishImage->getName();
			$filename = $path.$name;
		}

		Logger::info('file name - '.$filename);
    	header('Content-Type: image/png');
    	header('Content-Length: ' . filesize($filename));
		readfile($filename);

		return;
	}
}
?>