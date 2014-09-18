<?php
class GetBusinessFastImageLinksHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $base_host, $base_uri;

		$start = isset($_GET['start']) ? $_GET['start'] : 0;
		$size = isset($_GET['size']) ? $_GET['size'] : 10;
		$lookupDaos = LookupBusinessImageDao::getLookupDaosByBusinessId($params['businessid'], $start, $size);

		$links = array();
		foreach ($lookupDaos as $lookupDao) {
			$link = $base_host.$base_uri.'/display/business/'.$params['businessid'].'/fast/'.$lookupDao->getFastId();
			array_push($links, $link);
		}

		return array('status'=>'success', 'links'=>$links);
	}
}
?>