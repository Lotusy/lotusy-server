<?php
class GetCommentImageLinksHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $base_host, $base_uri;

		$lookupDaos = LookupCommentImageDao::getLookupDaosByCommentId($params['commentid']);

		$links = array();
		foreach ($lookupDaos as $lookupDao) {
			$link = $base_host.$base_uri.'/display/comment/'.$params['commentid'].'/'.$lookupDao->getFastId();
			array_push($links, $link);
		}

		return array('status'=>'success', 'links'=>$links);
	}
}
?>