<?php
class LookupCommentImageDao extends LookupCommentImageDaoGenerated {

//========================================================================================== public

	public static function getLookupDaosByCommentId($commentId, $start, $size) {
		$comment = new LookupCommentImageDao();
		$comment->setServerAddress($commentId);

		$builder = new QueryBuilder($comment);
		$rows = $builder->select('*')
						->where('comment_id', $commentId)
						->limit($start, $size)
						->findList();

		return $comment->makeObjectsFromSelectListResult($rows, 'LookupCommentImageDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getCommentId();
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>