<?php
class FollowingDao extends FollowingDaoGenerated {

// ========================================================================================== public

	public static function getFollowingIds($userId) {
		$follower = new FollowingDao();
		$follower->setServerAddress($userId);

		$builder = new QueryBuilder($follower);
		$rows = $builder->select('following_id')
						->where('user_id', $userId)
						->findList();

		$ids = array();
		foreach ($rows as $row) {
			array_push($ids, $row['following_id']);
		}

		return $ids;
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