<?php
class LookupCommentUserDao extends LookupCommentUserDaoGenerated {

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

	protected function beforeInsert() {
		$sequence = $this->var[LookupCommentUserDao::USERID];
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>