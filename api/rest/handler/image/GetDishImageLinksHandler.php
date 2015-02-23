<?php
class GetDishImageLinksHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $base_host, $base_uri;

		$lookupDaos = FastImageDao::getLookupDaosByDishId($params['dishid']);

		$links = array();
		foreach ($lookupDaos as $lookupDao) {
			$link = $base_host.$base_uri.'/display/dish/'.$params['dishid'].'/'.$lookupDao->getFastId();
			array_push($links, $link);
		}

		return array('status'=>'success', 'links'=>$links);
	}
}
?>