<?php
class DishDao extends DishDaoGenerated {

// =========================================================================================================== public

	public static function getBusinessDishes($businessId) {
		$dish = new DishDao();
		$dish->setServerAddress($businessId);

		$builder = new QueryBuilder($dish);
		$rows = $builder->select('*')
					    ->where('business_id', $businessId)
					    ->findList();

		return self::makeObjectsFromSelectListResult($rows, 'DishDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getBusinessId();
		$this->setShardId($sequence);

		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>