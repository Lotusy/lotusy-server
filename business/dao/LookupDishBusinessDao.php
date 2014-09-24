<?php
class LookupDishBusinessDao extends LookupDishBusinessDaoGenerated {

// =========================================================================================================== public

	public static function getBusinessDishes($businessId, $start, $size) {
		$lookup = new LookupDishBusinessDao();
		$lookup->setServerAddress($businessId);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('dish_id')
						->where('business_id', $businessId)
						->limit($start, $size)
						->findList();

		$ids = array();
		foreach ($rows as $row) {
			array_push($ids, $row['dish_id']);
		}

		return $ids;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getBusinessId();
		$this->setShardId($sequence);
	}

	protected function beforeUpdate() {
		$sequence = $this->getBusinessId();
		$this->setServerAddress($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>