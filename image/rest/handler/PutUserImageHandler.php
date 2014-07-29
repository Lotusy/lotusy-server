<?php
class PutUserImageHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $base_host, $base_uri, $comment_image_dir;

		$request = new GetCurrentUserProfileRequest();
		$response = $request->execute();

		$atReturn = array();
		if ($response['status']!='success') {
			header('HTTP/1.0 404 Not Found');
			$atReturn['status'] = 'error';
			$atReturn['description'] = 'user_not_found';
			return $atReturn;
		}

		$userId = $this->getUserId();

		$fileName = 'user_'.date('YmdHis').'_'.$userId.'_'.rand (0, 10000).'.png';

		$this->saveFile($comment_image_dir, $fileName);
		$this->saveUserImageDao($userId, $comment_image_dir, $fileName);

		$profilePic = $base_host.$base_uri.'/display/user/'.$userId;
		if ($response['profile_pic']!=$profilePic) {
			$request = new UpdateCurrentUserProfileRequest();
			$body = array();
			$body['profile_pic'] = $profilePic;
			$request->setBody($body);
			$request->execute();
		}

		$atReturn['status'] = 'success';

		return $atReturn;
	}

	private function saveFile($path, $name) {
		$imageDate = Utility::getRawRequestData();
		file_put_contents($path.$name, $imageDate);
	}

	private function saveUserImageDao($userId, $path, $name) {
		$userImage = new UserImageDao();
		$userImage->setUserId($userId);
		$userImage->setName($name);
		$userImage->setPath($path);
		$userImage->save();
	}
}
?>