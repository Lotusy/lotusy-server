<?php
class LookupCommentImageDao extends LookupCommentImageDaoGenerated {

//========================================================================================== public

	public static function getLookupDaosByCommentId($commentId) {
		$comment = new LookupCommentImageDao();
		$comment->setServerAddress($commentId);

		$builder = new QueryBuilder($comment);
		$res = $builder->select('*')
						->where('comment_id', $commentId)
						->findList();

		return $comment->makeObjectsFromSelectListResult($res, 'LookupCommentImageDao');
	}

	public static function isCommentImageExist($commentId, $imageId) {
		$lookup = new LookupCommentImageDao();
		$lookup->setServerAddress($commentId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('COUNT(*) as count')->where('comment_id', $commentId)->find();

		return $res['count']>0;
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