<?php
class LookupDishLikeUserDao extends LookupDishLikeUserDaoGenerated {

// =========================================================================================================== public

	public static function getUserResponseOnDish($userId, $dishId) {
		$lookup = new LookupDishLikeUserDao();
		$lookup->setServerAddress($userId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('*')
					   ->where('user_id', $userId)
					   ->where('dish_id', $dishId)
					   ->find();

		return self::makeObjectFromSelectResult($res, 'LookupDishLikeUserDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getUserId();
		$this->setShardId($sequence);
	}

	protected function beforeUpdate() {
		$sequence = $this->getUserId();
		$this->setServerAddress($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>