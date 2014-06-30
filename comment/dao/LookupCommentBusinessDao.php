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
		return $rows;
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
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>