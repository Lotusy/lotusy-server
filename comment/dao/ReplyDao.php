<?php
class ReplyDao extends LotusyDaoBase {

	const COMMENTID = 'comment_id';
	const USERID = 'user_id';
	const NICKNAME = 'nickname';
	const MESSAGE = 'message';
	const CREATETIME = 'create_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'comment';
	const TABLE = 'reply';
	const ODBNAME = 'comment';


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

	protected function init() {
		$this->var[ReplyDao::COMMENTID] = 0;
		$this->var[ReplyDao::USERID] = 0;
		$this->var[ReplyDao::MESSAGE] = '';
		$this->var[ReplyDao::NICKNAME] = '';
		$this->var[ReplyDao::CREATETIME] = date('Y-m-d H:i:s');
	}

	protected function beforeInsert() {
		$sequence = $this->var[ReplyDao::COMMENTID];
		$this->setShardId($sequence);
	}

	protected function getTableName() {
		return ReplyDao::TABLE;
	}

	protected function getIdColumnName() {
		return ReplyDao::IDCOLUMN;
	}

	protected function beforeUpdate() {
		$this->var[ReplyDao::MODIFIEDTIME] = date('Y-m-d H:i:s');
	}

	public function getShardDomain() {
		return ReplyDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return ReplyDao::ODBNAME;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>