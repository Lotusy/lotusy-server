<?php
class GetCommentImageLinksHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $base_host, $base_uri;

		$start = isset($_GET['start']) ? $_GET['start'] : 0;
		$size = isset($_GET['size']) ? $_GET['size'] : 10;
		$lookupDaos = LookupCommentImageDao::getLookupDaosByCommentId($params['commentid'], $start, $size);

		$links = array();
		foreach ($lookupDaos as $lookupDao) {
			$link = $base_host.$base_uri.'/display/comment/'.$lookupDao->var[LookupCommentImageDao::IMAGEID];
			array_push($links, $link);
		}

		return $links;
	}
}
?>