<?php
class DishHitlistDao extends DishHitlistDaoGenerated {

// ========================================================================================== public

	public static function getHitlistedDishes($userId, $start, $size) {
		$dishHitlist = new DishHitlistDao();
		$dishHitlist->setServerAddress($userId);

		$builder = new QueryBuilder($dishHitlist);
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

	public static function getDishCount($userId) {
		$dishHitlist = new DishHitlistDao();
		$dishHitlist->setServerAddress($userId);

		$builder = new QueryBuilder($dishHitlist);
		$res = $builder->select('COUNT(*) as count')
					   ->where('user_id', $userId)
					   ->find();

		return $res['count'];
	}

	public static function deleteDishHitlist($userId, $dishId) {
		$dishHitlist = new DishHitlistDao();
		$dishHitlist->setServerAddress($userId);

		$builder = new QueryBuilder($dishHitlist);
		$res = $builder->delete()
					   ->where('user_id', $userId)
					   ->where('dish_id', $dishId)
					   ->query();

		return $res;
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