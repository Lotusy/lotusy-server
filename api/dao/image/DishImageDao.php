<?php
class DishImageDao extends ImageDishDaoGenerated {

//========================================================================================== public

	public static function getImagesByDishId($dishId) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
					   ->where('dish_id', $dishId)
					   ->where('is_deleted', 'N')
					   ->findList();

		return self::makeObjectsFromSelectListResult($res, 'DishImageDao');
	}

	public static function getImagesByUserId($userId) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
					   ->where('user_id', $userId)
					   ->where('is_deleted', 'N')
					   ->findList();

		return self::makeObjectsFromSelectListResult($res, 'DishImageDao');
	}

	public static function deleteUserDishImage($userId, $dishId) {
		$builder = new QueryMaster();
		$res = $builder->update(array('is_deleted'=>'Y'),self::$table)
					   ->where('dish_id', $dishId)
					   ->where('user_id', $userId)
					   ->query();
		return $res;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
		$this->setIsDeleted('N');
	}
}
?>