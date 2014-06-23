<?php
class CommentAdminDao extends LotusyDaoBase {

	const EMAIL = 'email';
	const PASSWORD = 'password';
	const USERNAME = 'username';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'comment_admin';
	const TABLE = 'admin';
	const ODBNAME = 'comment_admin';

// =============================================== public function =================================================

	public static function login($email, $password) {
		$admin = new CommentAdminDao();
		$admin->setServerAddress( Utility::hashString($email) );

		$password = md5($password);

		$sql = "SELECT * FROM ".CommentAdminDao::TABLE." WHERE "
				.CommentAdminDao::EMAIL."='$email' AND "
				.CommentAdminDao::PASSWORD."='$password'";

		$connect = DBUtil::getConn($admin);
		$res = DBUtil::selectData($connect, $sql);

		return self::makeObjectFromSelectResult($res, 'CommentAdminDao');
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[CommentAdminDao::EMAIL] = '';
		$this->var[CommentAdminDao::PASSWORD] = '';
		$this->var[CommentAdminDao::USERNAME] = '';
	}

	protected function beforeInsert() {
		$this->var[CommentAdminDao::PASSWORD] = md5($this->var[CommentAdminDao::PASSWORD]);
		$sequence = Utility::hashString($this->var[CommentAdminDao::EMAIL]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return CommentAdminDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return CommentAdminDao::ODBNAME;
	}

	public function getTableName() {
		return CommentAdminDao::TABLE;
	}

	public function getIdColumnName() {
		return CommentAdminDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>