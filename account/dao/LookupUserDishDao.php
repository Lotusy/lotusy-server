<?php
class LookupUserDishDao extends LookupUserDishDaoGenerated {

	const LIST_COLLECTION = '0';
	const LIST_HITLIST = '1';

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
			$atReturn[$row['create_time']] = array('user_id'=>$row['user_id'], 'dish_id'=>$row['dish_id'], 'list'=>$row['list']);

			if (!isset($atReturn['dish_ids'][$row['dish_id']])) {
				$atReturn['dish_ids'][$row['dish_id']] = 1;
			}
		}

		return $atReturn;
	}

	public static function getUserRecentDishes($userId, $start, $size) {
		$lookup = new LookupUserDishDao();
		$lookup->setServerAddress(1);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('*')
						->where('user_id', $userId)
						->order('create_time', true)
						->limit($start, $size)
						->findList();

		$atReturn = array();
		$atReturn['dish_ids'] = array();
		foreach ($rows as $row) {
			$atReturn[$row['create_time']] = array();
			$atReturn[$row['create_time']] = array('dish_id'=>$row['dish_id'], 'list'=>$row['list']);

			if (!isset($atReturn['dish_ids'][$row['dish_id']])) {
				$atReturn['dish_ids'][$row['dish_id']] = 1;
			}
		}

		return $atReturn;
	}

	public static function getUserActivityCounts($userId, $start, $end) {
		$lookup = new LookupUserDishDao();
		$lookup->setServerAddress(1);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('create_time')
						->where('user_id', $userId)
						->where('create_time', $start, '>=')
						->where('create_time', $end, '<')
						->findList();
		$rv = array();
		foreach ($rows as $row) {
			$createTimes = substr($row['create_time'], 0, 10);
			if (!isset($rv[$createTimes])) {
				$rv[$createTimes] = 0;
			} else {
				$rv[$createTimes] = $rv[$createTimes]+1;
			}
		}

		return $rv;
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