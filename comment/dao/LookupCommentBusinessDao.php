<?php
class LookupCommentBusinessDao extends LookupCommentBusinessDaoGenerated {

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

	protected function beforeInsert() {
		$sequence = $this->var[LookupCommentBusinessDao::BUSINESSID];
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>