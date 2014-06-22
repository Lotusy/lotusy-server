<?php
class LookupCommentUserDao extends LotusyObject {

	const COMMENTID = 'comment_id';
	const USERID = 'user_id';
	const CREATETIME = 'create_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_comment';
	const TABLE = 'comment_user';
	const ODBNAME = 'lookup_comment';


//========================================================================================== public

	public static function getCommentIdsByUserId($userId, $start, $size) {
		$lookup = new LookupCommentUserDao();
		$lookup->setServerAddress($userId);

		$sql = "SELECT ".LookupCommentUserDao::COMMENTID." FROM ".LookupCommentUserDao::TABLE." WHERE ".
				LookupCommentUserDao::USERID."=$userId LIMIT $start, $size";

		$connect = DBUtil::getConn($lookup);
		return DBUtil::selectDataList($connect, $sql);
	}

	public static function deleteLookupDao($userId, $commentId) {
		$lookup = new LookupCommentUserDao();
		$lookup->setServerAddress($userId);

		$sql = "DELETE FROM ".LookupCommentUserDao::TABLE." WHERE ".LookupCommentUserDao::COMMENTID."=$commentId";

		$connect = DBUtil::getConn($lookup);

		return DBUtil::deleteData($connect, $sql);
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupCommentUserDao::COMMENTID] = 0;
		$this->var[LookupCommentUserDao::USERID] = 0;
		$this->var[LookupCommentUserDao::CREATETIME] = gmdate('Y-m-d H:i:s');
	}

	protected function beforeInsert() {
		$sequence = $this->var[LookupCommentUserDao::USERID];
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupCommentUserDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupCommentUserDao::ODBNAME;
	}

	public function getTableName() {
		return LookupCommentUserDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupCommentUserDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>