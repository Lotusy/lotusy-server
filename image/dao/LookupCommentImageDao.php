<?php
class LookupCommentImageDao extends LookupCommentImageDaoGenerated {

//========================================================================================== public

	public static function getLookupDaosByCommentId($commentId) {
		$comment = new LookupCommentImageDao();
		$comment->setServerAddress($commentId);

		$builder = new QueryBuilder($comment);
		$rows = $builder->select('*')
						->where('comment_id', $commentId)
						->findList();

		return $comment->makeObjectsFromSelectListResult($rows, 'LookupCommentImageDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getCommentId();
		$this->setShardId($sequence);

		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>