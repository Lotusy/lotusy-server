<?php
class LookupUserCollectDao extends LookupUserCollectDaoGenerated {

//========================================================================================== public

	public static function getUserCollectionCommentIds($userId, $start, $size) {
		$userCollection = new LookupUserCollectDao();
		$userCollection->setServerAddress($userId);

		$builder = new QueryBuilder($userCollection);
		$res = $builder->select('comment_id')
						->where('user_id', $userId)
						->limit($start, $size)
						->findList();
		$ids = array();
		foreach ($res as $row) {
			array_push($ids, $row['comment_id']);
		}

		return $ids;
	}

	public static function deleteLookupDao($userId, $commentId) {
		$lookup = new LookupUserCollectDao();
		$lookup->setServerAddress($userId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->delete()
					   ->where('comment_id', $commentId)
					   ->query();
		return $res;
	}

// ======================================================================================== override

	protected function beforeInsert() {
		$sequence = $this->getUserId();
		$this->setShardId($sequence);
		$this->setCreateTime(date('Y-m-d H:i:s'));
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>