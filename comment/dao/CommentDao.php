<?php
class CommentDao extends LotusyDaoBase {

	const BUSINESSID = 'business_id';
	const USERID = 'user_id';
	const LAT = 'lat';
	const LNG = 'lng';
	const MESSAGE = 'message';
	const LIKECOUNT = 'like_count';
	const ISDELETED = 'is_deleted';
	const CREATETIME = 'create_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'comment';
	const TABLE = 'comment';
	const ODBNAME = 'comment';


//========================================================================================== public

	public static function getCommentsByLocation($lat, $lng, $radius, $start, $size, $isMiles=false) {
		$commentIds = LookupCommentLocationDao::getCommentIdsByLocation ( 
														$lat, $lng, $radius, $start, $size, $isMiles );
		$comments = array();
		foreach ($commentIds as $commentId) {
			$comment = new CommentDao($commentId);
			array_push($comments, $comment);
		}

		return $comments;
	}

	public static function getCommentsByBusinessId($businessId, $start, $size) {
		$commentIds = LookupCommentBusinessDao::getCommentIdsByBusinessId ( 
																$businessId, $start, $size );
		$comments = array();
		foreach ($commentIds as $commentId) {
			$comment = new CommentDao($commentId);
			array_push($comments, $comment);
		}

		return $comments;
	}

	public static function getCommentsByUserId($userId, $start, $size) {
		$commentIds = LookupCommentUserDao::getCommentIdsByUserId($userId, $start, $size);

		$comments = array();
		foreach ($commentIds as $commentId) {
			$comment = new CommentDao($commentId);
			array_push($comments, $comment);
		}

		return $comments;
	}

	public function like() {
		$sql = "UPDATE ".CommentDao::TABLE." SET ".CommentDao::LIKECOUNT."=".CommentDao::LIKECOUNT."+1 WHERE ".
				CommentDao::IDCOLUMN."=".$this->var[CommentDao::IDCOLUMN];

		$connect = DBUtil::getConn($this);
		$res = DBUtil::updateData($connect, $sql);

		if ($res) {
			$this->var[CommentDao::LIKECOUNT] = $this->var[CommentDao::LIKECOUNT]+1;
		}

		return $res;
	}

	public function dislike() {
		$sql = "UPDATE ".CommentDao::TABLE." SET ".CommentDao::LIKECOUNT."=".CommentDao::LIKECOUNT."-1 WHERE ".
				CommentDao::IDCOLUMN."=".$this->var[CommentDao::IDCOLUMN];

		$connect = DBUtil::getConn($this);
		$res = DBUtil::updateData($connect, $sql);

		if ($res) {
			$this->var[CommentDao::LIKECOUNT] = $this->var[CommentDao::LIKECOUNT]-1;
		}

		return $res;
	}

	public function delete() {
		$sql = "UPDATE ".CommentDao::TABLE." SET ".CommentDao::ISDELETED."='Y' WHERE ".
				CommentDao::IDCOLUMN."=".$this->var[CommentDao::IDCOLUMN];

		$connect = DBUtil::getConn($this);
		$res = DBUtil::updateData($connect, $sql);

		return $res;
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[CommentDao::BUSINESSID] = 0;
		$this->var[CommentDao::USERID] = 0;
		$this->var[CommentDao::LAT] = 0;
		$this->var[CommentDao::LNG] = 0;
		$this->var[CommentDao::MESSAGE] = '';
		$this->var[CommentDao::LIKECOUNT] = 0;
		$this->var[CommentDao::ISDELETED] = 'N';
		$this->var[CommentDao::CREATETIME] = date('Y-m-d H:i:s');
	}

	protected function beforeInsert() {
		$lookup = new LookupCommentLocationDao();
		$lookup->var[LookupCommentLocationDao::LAT] = $this->var[CommentDao::LAT];
		$lookup->var[LookupCommentLocationDao::LNG] = $this->var[CommentDao::LNG];
		$lookup->var[LookupCommentLocationDao::COMMENTID] = $this->var[CommentDao::IDCOLUMN];
		$lookup->save();

		$lookup = new LookupCommentUserDao();
		$lookup->var[LookupCommentUserDao::USERID] = $this->var[CommentDao::USERID];
		$lookup->var[LookupCommentUserDao::COMMENTID] = $this->var[CommentDao::IDCOLUMN];
		$lookup->save();

		$lookup = new LookupCommentBusinessDao();
		$lookup->var[LookupCommentBusinessDao::BUSINESSID] = $this->var[CommentDao::BUSINESSID];
		$lookup->var[LookupCommentBusinessDao::COMMENTID] = $this->var[CommentDao::IDCOLUMN];
		$lookup->save();
	}

	protected function getTableName() {
		return CommentDao::TABLE;
	}

	protected function getIdColumnName() {
		return CommentDao::IDCOLUMN;
	}

	protected function beforeUpdate() {
		$this->var[CommentDao::MODIFIEDTIME] = date('Y-m-d H:i:s');
	}

	public function getShardDomain() {
		return CommentDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return CommentDao::ODBNAME;
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>