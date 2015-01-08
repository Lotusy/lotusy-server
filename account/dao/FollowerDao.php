<?php
class FollowerDao extends FollowerDaoGenerated {

// ========================================================================================== public

	public static function getFollowerIds($userId, $start, $size) {
		$builder = new QueryMaster();
		$res = $builder->select('follower_id', self::$table)
						->where('user_id', $userId)
						->limit($start, $size)
						->findList();
		$ids = array();
		foreach ($res as $row) {
			array_push($ids, $row['follower_id']);
		}

		return $ids;
	}

	public static function getUserFollowerCount($user) {
		$builder = new QueryMaster();
		$res = $builder->select('COUNT(*) as count', self::$table)
					   ->where('user_id', $userId)
					   ->find();

		return $res['count'];
	}


// ======================================================================================== override

}
?>