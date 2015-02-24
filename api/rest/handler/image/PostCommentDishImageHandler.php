<?php
class PostCommentDishImageHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $comment_image_dir;

		$userId = $this->getUserId();

		$fileName = 'fast_'.date('YmdHis').'_'.$userId.'_'.rand (0, 10000).'.png';

		$imageDate = Utility::getRawRequestData();

		file_put_contents($comment_image_dir.$fileName, $imageDate);


		$image = new FastImageDao();
		$image->setName($fileName);
		$image->setPath($comment_image_dir);
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