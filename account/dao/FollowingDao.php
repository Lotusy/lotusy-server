<?php
class FollowingDao extends FollowingDaoGenerated {

// ========================================================================================== public

	public static function getFollowingIds($userId, $start, $size) {
		$builder = new QueryMaster();
		$res = $builder->select('following_id', self::$table)
						->where('user_id', $userId)
						->limit($start, $size)
						->findList();
		$ids = array();
		foreach ($res as $row) {
			array_push($ids, $row['following_id']);
		}

		return $ids;
	}

	public static function getUserFollowingCount($user) {
		$builder = new QueryMaster();
		$res = $builder->select('COUNT(*) as count', self::$table)
					   ->where('user_id', $userId)
					   ->find();

		return $res['count'];
	}

	public static function isUserFollowings($userId, $followingIds) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
					   ->where('user_id', $userId)
					   ->in('following_id', $followingIds)
					   ->findList();
		$ids = array();
		foreach ($res as $row) {
			array_push($ids, $row['following_id']);
		}

		return $ids;
	}

// ======================================================================================== override

}
?>