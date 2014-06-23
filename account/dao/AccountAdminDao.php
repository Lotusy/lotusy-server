<?php
class AccountAdminDao extends LotusyDaoBase {

	const EMAIL = 'email';
	const PASSWORD = 'password';
	const USERNAME = 'username';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'account_admin';
	const TABLE = 'admin';
	const ODBNAME = 'account_admin';

// =============================================== public function =================================================

	public static function login($email, $password) {
		$admin = new AccountAdminDao();
		$admin->setServerAddress( Utility::hashString($email) );

		$password = md5($password);

		$sql = "SELECT * FROM ".AccountAdminDao::TABLE." WHERE "
				.AccountAdminDao::EMAIL."='$email' AND "
				.AccountAdminDao::PASSWORD."='$password'";

		$connect = DBUtil::getConn($admin);
		$res = DBUtil::selectData($connect, $sql);

		return self::makeObjectFromSelectResult($res, 'AccountAdminDao');
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[AccountAdminDao::EMAIL] = '';
		$this->var[AccountAdminDao::PASSWORD] = '';
		$this->var[AccountAdminDao::USERNAME] = '';
	}

	protected function beforeInsert() {
		$this->var[AccountAdminDao::PASSWORD] = md5($this->var[AccountAdminDao::PASSWORD]);
		$sequence = Utility::hashString($this->var[AccountAdminDao::EMAIL]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return AccountAdminDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return AccountAdminDao::ODBNAME;
	}

	public function getTableName() {
		return AccountAdminDao::TABLE;
	}

	public function getIdColumnName() {
		return AccountAdminDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>