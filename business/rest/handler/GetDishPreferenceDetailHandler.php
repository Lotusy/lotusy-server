<?php
class GetDishPreferenceDetailHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$json = $_GET;

		$dishId = $params['dishid'];
		$userId = $this->getUserId();

		$start = $json['start'];
		$size = $json['size'];

		$dishResponses = DishUserLikeDao::getResponsesOnDish($dishId, $start, $size);

		global $base_image_host;

		$elements = array();
		$userIds = array();
		foreach ($dishResponses as $dishResponse) {
			$element = array();
			$element['user_id'] = $dishResponse->getUserId();
			$element['user_pic_url'] = $base_image_host.'/display/user/'.$dishResponse->getUserId();
			$element['is_like'] = $dishResponse->getIsLike()=='Y';
			$element['is_buddy'] = false;
			$elements[] = $element;

			$userIds[] = $dishResponse->getUserId();
		}

		$accessToken = $this->getAccessToken();

		$request = new FilterUserFollowingsRequest($userIds, $accessToken);
		$followings = $request->execute();

		foreach ($elements as $key=>$element) {
			if (in_array($element['user_id'], $followings)) {
				$elements[$key]['is_buddy'] = true;
			}
		}

		$request = new GetUserNicknamesRequest($userIds, $accessToken);
		$nicknames = $request->execute();

		foreach ($elements as $key=>$element) {
			$nickname = $nicknames[$element['user_id']];
			$elements[$key]['nickname'] = $nickname;
		}

		$response = array('status'=>'success');
		$response['detail'] = $elements;

		return $response;
	}
}
?>