<?php
class LookupCommentBusinessDao extends LookupCommentBusinessDaoGenerated {

//========================================================================================== public

	public static function getCommentIdsByBusinessId($businessId, $start, $size) {
		$lookup = new LookupCommentBusinessDao();
		$lookup->setServerAddress($businessId);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('comment_id')
						->where('business_id', $businessId)
						->limit($start, $size)
						->findList();
		$ids = array();
		foreach ($rows as $row) {
			array_push($ids, $row['comment_id']);
		}

		return $ids;
	}

	public static function getCommentCountByBusinessId($businessId) {
		$lookup = new LookupCommentBusinessDao();
		$lookup->setServerAddress($businessId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('COUNT(*) as count')
					   ->where('business_id', $businessId)
					   ->find();

		return $res['count'];
	}

	public static function deleteLookupDao($businessId, $commentId) {
		$lookup = new LookupCommentBusinessDao();
		$lookup->setServerAddress($businessId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->delete()
					   ->where('comment_id', $commentId)
					   ->query();
		return $res;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getBusinessId();
		$this->setShardId($sequence);

		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>