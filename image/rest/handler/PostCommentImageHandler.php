<?php
class PostCommentImageHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $base_comment_host, $app_key, $comment_image_dir;

		$request = new GetCommentInfoRequest();
		$request->setUri($base_comment_host.'/rest/comment/'.$params['commentid']);

		$headers = apache_request_headers();
		$header = array();
		$header['app-key'] = $app_key;
		$header['Authorization'] = $headers['Authorization'];
		$request->setHeader($header);

		$response = $request->execute();

		$atReturn = array();
		if ($response['status']!='success') {
			header('HTTP/1.0 404 Not Found');
			$atReturn['status'] = 'error';
			$atReturn['description'] = 'comment_not_found';
			return $atReturn;
		}

		$userId = $this->getUserId();

		$fileName = 'comment_'.gmdate('YmdHis').'_'.$userId.'_'.$params['commentid'].'_'.rand (0, 10000).'.jpg';

		$this->saveFile($comment_image_dir, $fileName);
		$imageId = $this->saveCommentImageDao($params['commentid'], $comment_image_dir, $fileName);
		$this->saveLookupDaos($userId, $response['business_id'], $params['commentid'], $imageId);

		$atReturn['status'] = 'success';
		$atReturn['image_id'] = $imageId;

		return $atReturn;
	}

	private function saveFile($path, $name) {
		$imageDate = Utility::getRawRequestData();
		file_put_contents($path.$name, $imageDate);
	}

	private function saveCommentImageDao($commentId, $path, $name) {
		$commentImage = new CommentImageDao();
		$commentImage->var[CommentImageDao::COMMENTID] = $commentId;
		$commentImage->var[CommentImageDao::NAME] = $name;
		$commentImage->var[CommentImageDao::PATH] = $path;
		$commentImage->save();

		return $commentImage->var[CommentImageDao::IDCOLUMN];
	}

	private function saveLookupDaos($userId, $businessId, $commentId, $imageId) {
		$lookupUser = new LookupUserImageDao();
		$lookupUser->var[LookupUserImageDao::IMAGEID] = $imageId;
		$lookupUser->var[LookupUserImageDao::USERID] = $userId;
		$lookupUser->save();

		$lookupBusiness = new LookupBusinessImageDao();
		$lookupBusiness->var[LookupBusinessImageDao::IMAGEID] = $imageId;
		$lookupBusiness->var[LookupBusinessImageDao::BUSINESSID] = $businessId;
		$lookupBusiness->save();

		$lookupComment = new LookupCommentImageDao();
		$lookupComment->var[LookupCommentImageDao::IMAGEID] = $imageId;
		$lookupComment->var[LookupCommentImageDao::COMMENTID] = $commentId;
		$lookupComment->save();
	}
}
?>