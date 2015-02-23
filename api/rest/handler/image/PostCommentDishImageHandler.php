<?php
class PostCommentDishImageHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $comment_image_dir;

		$userId = $this->getUserId();

		$fileName = 'fast_'.date('YmdHis').'_'.$userId.'_'.rand (0, 10000).'.png';

		$imageDate = Utility::getRawRequestData();

		file_put_contents($path.$name, $imageDate);


		$image = new FastImageDao();
		$image->setName($name);
		$image->setPath($path);
		$image->setUserId($userId);
		$image->setCommentId($params['commentid']);
		$image->setDishId($params['dishid']);
		$image->save();


		$atReturn['status'] = 'success';
		$atReturn['image_id'] = $image->getId();

		return $atReturn;
	}
}
?>