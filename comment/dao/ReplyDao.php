<?php
class ReplyDao extends ReplyDaoGenerated {

//========================================================================================== public

	public static function getRepliesByCommentId($commentId, $start, $size) {
		$comment = new ReplyDao();
		$comment->setServerAddress($commentId);

		$builder = new QueryBuilder($comment);
		$res = $builder->select('*')
						->where('comment_id', $commentId)
						->limit($start, $size)
						->findList();

		return self::makeObjectsFromSelectListResult($res, 'ReplyDao');
	}

	public static function getReplyCountByCommentId($commentId) {
		$comment = new ReplyDao();
		$comment->setServerAddress($commentId);

		$builder = new QueryBuilder($comment);
		$res = $builder->select('COUNT(*) as count')
					   ->where('comment_id', $commentId)
					   ->find();

		return $res['count'];
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