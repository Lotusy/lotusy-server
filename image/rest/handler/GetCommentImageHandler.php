<?php
class GetCommentImageHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$commentImage = new CommentImageDao($params['imageid']);

		if (!$commentImage->isFromDatabase()) {
			global $base_host, $comment_image_default;
			header('HTTP/1.0 404 Not Found');
			$filename = $base_host.$comment_image_default;
		} else {
			$path = $commentImage->var[CommentImageDao::PATH];
			$name = $commentImage->var[CommentImageDao::NAME];
			$filename = $path.$name;
		}

    	header('Content-Type: image/jpeg');
		readfile($filename);
	}
}
?>