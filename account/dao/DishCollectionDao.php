<?php
class DishCollectionDao extends DishCollectionDaoGenerated {

// ========================================================================================== public

	public static function getCollectedDishes($userId, $start, $size) {
		$dishCollection = new DishCollectionDao();
		$dishCollection->setServerAddress($userId);

		$builder = new QueryBuilder($dishCollection);
		$rows = $builder->select('dish_id')
						->where('user_id', $userId)
						->limit($start, $size)
						->findList();
		$ids = array();
		foreach ($rows as $row) {
			array_push($ids, $row['dish_id']);
		}

		return $ids;
	}

// ======================================================================================== override

	protected function beforeInsert() {
		$sequence = $this->getUserId();
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>