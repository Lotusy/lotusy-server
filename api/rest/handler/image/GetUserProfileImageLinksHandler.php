<?php
class GetUserProfileImageLinksHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		global $base_host, $base_uri;
		$ids = UserImageDao::getImageDaoIdsByUserId($params['userid']);

		$response = array();
		$response['status'] = 'success';

		$links = array();
		foreach ($ids as $id) {
			$link = $base_host.$base_uri.'/display/user/'.$params['userid'].'/'.$id;
			array_push($links, $link);
		}

		$response['links'] = $links;

		return $response;
	}
}
?>