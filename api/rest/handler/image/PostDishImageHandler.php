<?php
class PostDishImageHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $comment_image_dir;

		$userId = $this->getUserId();
		$dishId = $params['dishid'];

		$fileName = 'dish_'.$dishId.'_'.date('YmdHis').'_user_'.$userId.'_'.rand (0, 10000).'.png';

		$imageDate = Utility::getRawRequestData();

		file_put_contents($comment_image_dir.$fileName, $imageDate);

		DishImageDao::deleteUserDishImage($userId, $dishId);

		$image = new DishImageDao();
		$image->setName($fileName);
		$image->setPath($comment_image_dir);
		$image->setUserId($userId);
		$image->setDishId($dishId);
		$image->save();


		$atReturn['status'] = 'success';
		$atReturn['image_id'] = $image->getId();

		return $atReturn;
	}
}
?>