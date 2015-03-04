<?php
class GetDishProfileImageLinksHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $base_host, $base_uri;

		$imageDaos = DishImageDao::getImagesByDishId($params['dishid']);

		$links = array();
		foreach ($imageDaos as $imageDao) {
			$link = $base_host.$base_uri.'/image/dish/'.$params['dishid'].'/user/'.$imageDao->getUserId().'/display';
			$links[$imageDao->getId()] = $link;
		}

		return array('status'=>'success', 'links'=>$links);
	}
}
?>