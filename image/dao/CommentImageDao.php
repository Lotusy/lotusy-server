<?php
class CommentImageDao extends CommentImageDaoGenerated {

//========================================================================================== public

	public static function getImagesByCommentId($commentId) {
		$comment = new CommentImageDao();
		$comment->setServerAddress($commentId);

		$builder = new QueryBuilder($comment);
		$rows = $builder->select('*')
						->where('comment_id', $commentId)
						->findList();

		return self::makeObjectsFromSelectListResult($rows, 'CommentImageDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = gmdate('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function beforeUpdate() {}

	protected function isShardBaseObject() {
		return true;
	}
}
?>