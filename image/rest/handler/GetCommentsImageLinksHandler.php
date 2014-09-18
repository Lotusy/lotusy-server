<?php
class GetCommentsImageLinksHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $base_host, $base_uri;

		$commentIds = explode(',', $params['commentids']);

		$links = array();
		foreach ($commentIds as $commentId) {
			$lookupDaos = LookupCommentImageDao::getLookupDaosByCommentId($commentId);

			$commentLinks = array();
			foreach ($lookupDaos as $lookupDao) {
				$commentLink = $base_host.$base_uri.'/display/comment/'.$params['commentid'].'/'.$lookupDao->getFastId();
				array_push($commentLinks, $commentLink);
			}

			$links[$commentId] = $commentLinks;
		}

		return array('status'=>'success', 'links'=>$links);
	}
}
?>