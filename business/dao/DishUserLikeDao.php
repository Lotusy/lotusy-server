<?php
class DishUserLikeDao extends DishUserLikeDaoGenerated {

// =============================================== public function =================================================

	public static function getUserResponseOnDish($userId, $dishId) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
					   ->where('user_id', $userId)
					   ->where('dish_id', $dishId)
					   ->find();

		return self::makeObjectFromSelectResult($res, 'DishUserLikeDao');
	}

// ============================================ override functions ==================================================

}
?>