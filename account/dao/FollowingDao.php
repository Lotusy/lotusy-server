<?php
class FollowingDao extends FollowingDaoGenerated {

// ========================================================================================== public

	public static function getFollowingIds($userId, $start, $size) {
		$following = new FollowingDao();
		$following->setServerAddress($userId);

		$builder = new QueryBuilder($following);
		$res = $builder->select('following_id')
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
		$following = new FollowingDao();
		$following->setServerAddress($userId);

		$builder = new QueryBuilder($following);
		$res = $builder->select('COUNT(*) as count')
					   ->where('user_id', $userId)
					   ->find();

		return $res['count'];
	}


// ======================================================================================== override

	protected function beforeInsert() {
		$userId = $this->getUserId();
		$sequence = Utility::hashString($userId);
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>