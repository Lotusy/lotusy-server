<?php
class DishDislikeHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$userId = $this->getUserId();
		$dishId = $params['dishid'];

		$history = LookupDishLikeUserDao::getUserResponseOnDish($userId, $dishId);

		if (isset($history)) {
			$like = $history->getIsLike()=='Y';

			if ($like) {
				$history->setIsLike('N');
				$history->save();

				$dish = new DishDao($dishId);
				$dish->like(false);
				$dish->dislike();
			}
		} else {
			$lookup = new LookupDishLikeUserDao();
			$lookup->setDishId($dishId);
			$lookup->setUserId($userId);
			$lookup->setIsLike('N');
			$lookup->save();

			$dish = new DishDao($dishId);
			$dish->dislike();
		}

		$response = array('status' => 'success');

		return $response;
	}
}
?>