<?php
class HitlistDishHandler extends UnauthorizedRequestHandler {

	public function handle($params) {
		$validator = new HitlistDishValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$dishHitlistion = new DishHitlistDao();
		$dishHitlistion->setDishId($params['dishid']);
		$dishHitlistion->setUserId($validator->getUserId());
		$dishHitlistion->save();

		$lookup = new LookupUserDishDao();
		$lookup->setDishId($params['dishid']);
		$lookup->setUserId($validator->getUserId());
		$lookup->setList(LookupUserDishDao::LIST_HITLIST);
		$lookup->setCreateTime(date('Y-m-d H:i:s'));
		$lookup->save();

		$response = array();
		$response['status'] = 'success';

		return $response;
	}
}
?>