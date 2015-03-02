<?php
class PostDishImageHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $image_dir;

		$userId = $this->getUserId();
		$dishId = $params['dishid'];

		$fileName = 'dish_'.$dishId.'_'.date('YmdHis').'_user_'.$userId.'_'.rand (0, 10000).'.png';

		$imageData = Utility::getRawRequestData();

		if (empty($imageData)) {
			header('HTTP/1.0 400 Bad Request');
			$response = array('status'=>'error');
			$response['description'] = 'no_image_file_provided';
			return $response;
		}

		file_put_contents($image_dir.$fileName, $imageData);

		DishImageDao::deleteUserDishImage($userId, $dishId);

		$hasDefault = DishImageDao::DishHasDefaultImage($dishId);

		$image = new DishImageDao();
		$image->setName($fileName);
		$image->setPath($image_dir);
		$image->setUserId($userId);
		$image->setDishId($dishId);
		$image->setIsDefault($hasDefault ? 'N' : 'Y');
		$image->save();

		$atReturn['status'] = 'success';
		$atReturn['image_id'] = $image->getId();

		return $atReturn;
	}
}
?>