<?php
class LookupCommentBusinessDao extends LotusyDaoBase {

	const COMMENTID = 'comment_id';
	const BUSINESSID = 'business_id';
	const CREATETIME = 'create_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_comment';
	const TABLE = 'comment_business';
	const ODBNAME = 'lookup_comment';


//========================================================================================== public

	public static function getCommentIdsByBusinessId($businessId, $start, $size) {
		$lookup = new LookupCommentBusinessDao();
		$lookup->setServerAddress($businessId);

		$sql = "SELECT ".LookupCommentBusinessDao::COMMENTID." FROM ".LookupCommentBusinessDao::TABLE." WHERE ".
				LookupCommentBusinessDao::BUSINESSID."=$businessId LIMIT $start, $size";

		$connect = DBUtil::getConn($lookup);
		return DBUtil::selectDataList($connect, $sql);
	}

	public static function deleteLookupDao($businessId, $commentId) {
		$lookup = new LookupCommentBusinessDao();
		$lookup->setServerAddress($businessId);

		$sql = "DELETE FROM ".LookupCommentBusinessDao::TABLE." WHERE ".LookupCommentBusinessDao::COMMENTID."=$commentId";

		$connect = DBUtil::getConn($lookup);

		return DBUtil::deleteData($connect, $sql);
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupCommentBusinessDao::COMMENTID] = 0;
		$this->var[LookupCommentBusinessDao::BUSINESSID] = 0;
		$this->var[LookupCommentBusinessDao::CREATETIME] = gmdate('Y-m-d H:i:s');
	}

	protected function beforeInsert() {
		$sequence = $this->var[LookupCommentBusinessDao::BUSINESSID];
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupCommentBusinessDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupCommentBusinessDao::ODBNAME;
	}

	public function getTableName() {
		return LookupCommentBusinessDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupCommentBusinessDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>