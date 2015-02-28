<?php
class CollectDishHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$validator = new CollectDishValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$dishActivity = new DishActivityDao();
		$dishActivity->setDishId($params['dishid']);
		$dishActivity->setUserId($validator->getUserId());
		$dishActivity->setActivity(DishActivityDao::LIST_COLLECTION);
		
		if ($dishActivity->save()) {
			DishActivityDao::deleteUserDishHitlist($this->getUserId(), $params['dishid']);

			$response = array();
			$response['status'] = 'success';
		} else {
			$response['status'] = 'success';
			$response['description'] = 'Error occur when save activity.';
		}

		return $response;
	}
}
?>