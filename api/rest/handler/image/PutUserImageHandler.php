<?php
class PutUserImageHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $base_host, $base_uri, $comment_image_dir;

		$userId = $this->getUserId();

		$fileName = 'user_'.date('YmdHis').'_'.$userId.'_'.rand (0, 10000).'.png';

		$imageDate = Utility::getRawRequestData();
		file_put_contents($comment_image_dir.$fileName, $imageDate);

		$userImage = new UserImageDao();
		$userImage->setUserId($userId);
		$userImage->setName($fileName);
		$userImage->setPath($comment_image_dir);
		$userImage->save();

		$profilePic = $base_host.$base_uri.'/display/user/'.$userId;

		$userDao = new UserDao($userId);
		$userDao->setProfilePic($profilePic);
		$userDao->save();

		$atReturn['status'] = 'success';

		return $atReturn;
	}
}
?>