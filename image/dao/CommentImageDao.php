<?php
class CommentImageDao extends LotusyObject {

	const COMMENTID = 'comment_id';
	const NAME = 'name';
	const PATH = 'path';
	const CREATETIME = 'create_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'image_comment';
	const TABLE = 'image_comment';
	const ODBNAME = 'image_comment';


//========================================================================================== public

	public static function getImagesByCommentId($commentId) {
		$sql = "SELECT * FROM ".CommentImageDao::TABLE." WHERE ".CommentImageDao::COMMENTID."=$commentId";

		$connect = DBUtil::getConn($this);
		$rows = DBUtil::selectDataList($connect, $sql);

		return $this->makeObjectsFromSelectListResult($rows, 'CommentImageDao');
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[CommentImageDao::COMMENTID] = 0;
		$this->var[CommentImageDao::NAME] = '';
		$this->var[CommentImageDao::PATH] = '';
		$this->var[CommentImageDao::CREATETIME] = date('Y-m-d H:i:s');
	}

	protected function getTableName() {
		return CommentImageDao::TABLE;
	}

	protected function getIdColumnName() {
		return CommentImageDao::IDCOLUMN;
	}

	protected function actionBeforeUpdate() {
		$this->var[CommentImageDao::MODIFIEDTIME] = date('Y-m-d H:i:s');
	}

	public function getShardDomain() {
		return CommentImageDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return CommentImageDao::ODBNAME;
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>