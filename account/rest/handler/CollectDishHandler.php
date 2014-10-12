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

		$lookup = new LookupUserDishDao();
		$lookup->setDishId($params['dishid']);
		$lookup->setUserId($validator->getUserId());
		$lookup->setList(LookupUserDishDao::LIST_COLLECTION);
		$lookup->setCreateTime(date('Y-m-d H:i:s'));
		$lookup->save();

		DishHitlistDao::deleteDishHitlist($validator->getUserId(), $params['dishid']);

		$response = array();
		$response['status'] = 'success';

		return $response;
	}
}
?>