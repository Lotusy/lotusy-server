<?php
class HitlistDishHandler extends AuthorizedRequestHandler {

	public function handle($params) {
		$params['userid'] = $this->getUserId();

		$validator = new HitlistDishValidator($params);
		if (!$validator->validate()) {
			return $validator->getMessage();
		}

		$lookup = new DishActivityDao();
		$lookup->setDishId($params['dishid']);
		$lookup->setUserId($validator->getUserId());
		$lookup->setActivity(DishActivityDao::LIST_HITLIST);
		$lookup->save();

		$response = array();
		$response['status'] = 'success';

		return $response;
	}
}
?>