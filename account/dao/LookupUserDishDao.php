<?php
class LookupUserDishDao extends LookupUserDishDaoGenerated {

// ========================================================================================== public

	public static function getUsersRecentDishes($userIds, $start, $size) {
		$lookup = new LookupUserDishDao();
		$lookup->setServerAddress(1);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('*')
						->in('user_id', $userIds)
						->order('create_time', true)
						->limit($start, $size)
						->findList();

		$atReturn = array();
		$atReturn['dish_ids'] = array();
		foreach ($rows as $row) {
			$atReturn[$row['create_time']] = array();
			$atReturn[$row['create_time']] = array('user_id'=>$row['user_id'], 'dish_id'=>$row['dish_id']);

			if (!isset($atReturn['dish_ids'][$row['dish_id']])) {
				$atReturn['dish_ids'][$row['dish_id']] = 1;
			}
		}

		return $atReturn;
	}

// ======================================================================================== override

	protected function beforeInsert() {
		$sequence = 1;
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>