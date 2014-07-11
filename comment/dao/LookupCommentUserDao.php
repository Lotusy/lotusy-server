<?php
class LookupCommentUserDao extends LookupCommentUserDaoGenerated {

//========================================================================================== public

	public static function getCommentIdsByUserId($userId, $start, $size) {
		$lookup = new LookupCommentUserDao();
		$lookup->setServerAddress($userId);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('comment_id')
						->where('user_id', $userId)
						->limit($start, $size)
						->findList();
		return $rows;
	}

	public static function deleteLookupDao($userId, $commentId) {
		$lookup = new LookupCommentUserDao();
		$lookup->setServerAddress($userId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->delete()
					   ->where('comment_id', $commentId)
					   ->query();
		return $res;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getUserId();
		$this->setShardId($sequence);

		$date = gmdate('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>