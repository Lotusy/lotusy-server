<?php
class GetDishImageHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$imageId = $params['imageid'];

		if ($imageId=='default') {
			$lookupDishImageDao = FastImageDao::getDefaultDishFastImage($imageId);
			$fastImage = new FastImageDao($lookupDishImageDao->getFastId());
		} else if (FastImageDao::isDishImageExist($params['dishid'], $params['imageid'])) {
			$fastImage = new FastImageDao($params['imageid']);
		}

		if (!isset($fastImage) || !$fastImage->isFromDatabase()) {
			global $base_host, $comment_image_default;
			header('HTTP/1.0 404 Not Found');
			$filename = $base_host.$comment_image_default;
		} else {
			$path = $fastImage->getPath();
			$name = $fastImage->getName();
			$filename = $path.$name;
		}

    	header('Content-Type: image/png');
		readfile($filename);
	}
}
?>