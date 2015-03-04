<?php
class PostUserSignatureImageHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $image_dir;

		$userId = $this->getUserId();

		$fileName = 'signature_'.date('YmdHis').'_user_'.$userId.'_'.rand (0, 10000).'.png';

		$imageData = Utility::getRawRequestData();

		if (empty($imageData)) {
			header('HTTP/1.0 400 Bad Request');
			$response = array('status'=>'error');
			$response['description'] = 'no_image_file_provided';
			return $response;
		}

		file_put_contents($image_dir.$fileName, $imageData);

		$image = new SignatureImageDao();
		$image->setName($fileName);
		$image->setPath($image_dir);
		$image->setUserId($userId);
		$image->save();

		$atReturn['status'] = 'success';
		$atReturn['image_id'] = $image->getId();

		return $atReturn;
	}
}
?>