<?php
class ReplyDao extends ReplyDaoGenerated {

//========================================================================================== public

	public static function getRepliesByCommentId($commentId, $start, $size) {
		$comment = new ReplyDao();
		$comment->setServerAddress($commentId);

		$sql = "SELECT * FROM ".ReplyDao::TABLE." WHERE ".ReplyDao::COMMENTID."=$commentId LIMIT $start, $size";

		$connect = DBUtil::getConn($comment);
		$rows = DBUtil::selectDataList($connect, $sql);

		return $comment->makeObjectsFromSelectListResult($rows, 'ReplyDao');
	}

	public static function getReplyCountByCommentId($commentId) {
		$comment = new ReplyDao();
		$comment->setServerAddress($commentId);

		$sql = "SELECT COUNT(*) as count FROM ".ReplyDao::TABLE." WHERE ".ReplyDao::COMMENTID."=$commentId";

		$connect = DBUtil::getConn($comment);
		$res = DBUtil::selectData($connect, $sql);

		return $res['count'];
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->var[ReplyDao::COMMENTID];
		$this->setShardId($sequence);
	}

	protected function beforeUpdate() {
		$this->var[ReplyDao::MODIFIEDTIME] = date('Y-m-d H:i:s');
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>