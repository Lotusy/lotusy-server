<?php
class GetUserProfileDefaultImageHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$userImage = UserImageDao::getImageDaoByUserId($params['userid']);
		if (!isset($userImage)) {
			global $base_host, $user_image_default;
			header('HTTP/1.0 404 Not Found');
			$filename = $base_host.$user_image_default;
		} else {
			$path = $userImage->getPath();
			$name = $userImage->getName();
			$filename = $path.$name;
		}

    	header('Content-Type: image/png');
		readfile($filename);
	}
}
?>