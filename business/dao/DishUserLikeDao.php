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

	public static function getResponsesOnDish($dishId, $start, $size) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
					   ->where('dish_id', $dishId)
					   ->limit($start, $size)
					   ->findList();

		return self::makeObjectsFromSelectListResult($res, 'DishUserLikeDao');
	}

// ============================================ override functions ==================================================

}
?>