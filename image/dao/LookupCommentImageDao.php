<?php
class LookupCommentImageDao extends LotusyObject {

	const COMMENTID = 'comment_id';
	const IMAGEID = 'image_id';
	const CREATETIME = 'create_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_comment_image';
	const TABLE = 'comment_image';
	const ODBNAME = 'lookup_comment_image';


//========================================================================================== public

	public static function getLookupDaosByCommentId($commentId, $start, $size) {
		$comment = new LookupCommentImageDao();
		$comment->setServerAddress($commentId);

		$sql = "SELECT * FROM ".LookupCommentImageDao::TABLE." WHERE ".
				LookupCommentImageDao::COMMENTID."=$commentId LIMIT $start, $size";

		$connect = DBUtil::getConn($comment);
		$rows = DBUtil::selectDataList($connect, $sql);

		return $comment->makeObjectsFromSelectListResult($rows, 'LookupCommentImageDao');
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupCommentImageDao::COMMENTID] = 0;
		$this->var[LookupCommentImageDao::IMAGEID] = 0;
		$this->var[LookupCommentImageDao::CREATETIME] = gmdate('Y-m-d H:i:s');
	}

	protected function beforeInsert() {
		$sequence = $this->var[LookupCommentImageDao::COMMENTID];
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupCommentImageDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupCommentImageDao::ODBNAME;
	}

	public function getTableName() {
		return LookupCommentImageDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupCommentImageDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>