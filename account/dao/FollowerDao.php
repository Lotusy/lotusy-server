<?php
class FollowerDao extends FollowerDaoGenerated {

// ========================================================================================== public

	public static function getFollowerIds($userId, $start, $size) {
		$follower = new FollowerDao();
		$follower->setServerAddress($userId);

		$builder = new QueryBuilder($follower);
		$res = $builder->select('follower_id')
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
		$follower = new FollowerDao();
		$follower->setServerAddress($userId);

		$builder = new QueryBuilder($follower);
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