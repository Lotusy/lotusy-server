<?php
class CollectDishHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$validator = new CollectDishValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$dishCollection = new DishCollectionDao();
		$dishCollection->setDishId($params['dishid']);
		$dishCollection->setUserId($validator->getUserId());
		$dishCollection->save();

		$response = array();
		$response['status'] = 'success';

		return $response;
	}
}
?>