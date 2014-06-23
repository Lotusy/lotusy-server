<?php
class BusinessAdminDao extends LotusyDaoBase {

	const EMAIL = 'email';
	const PASSWORD = 'password';
	const USERNAME = 'username';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'business_admin';
	const TABLE = 'admin';
	const ODBNAME = 'business_admin';

// =============================================== public function =================================================

	public static function login($email, $password) {
		$admin = new BusinessAdminDao();
		$admin->setServerAddress( Utility::hashString($email) );

		$password = md5($password);

		$sql = "SELECT * FROM ".BusinessAdminDao::TABLE." WHERE "
				.BusinessAdminDao::EMAIL."='$email' AND "
				.BusinessAdminDao::PASSWORD."='$password'";

		$connect = DBUtil::getConn($admin);
		$res = DBUtil::selectData($connect, $sql);

		return self::makeObjectFromSelectResult($res, 'BusinessAdminDao');
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[BusinessAdminDao::EMAIL] = '';
		$this->var[BusinessAdminDao::PASSWORD] = '';
		$this->var[BusinessAdminDao::USERNAME] = '';
	}

	protected function beforeInsert() {
		$this->var[BusinessAdminDao::PASSWORD] = md5($this->var[BusinessAdminDao::PASSWORD]);
		$sequence = Utility::hashString($this->var[BusinessAdminDao::EMAIL]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return BusinessAdminDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return BusinessAdminDao::ODBNAME;
	}

	public function getTableName() {
		return BusinessAdminDao::TABLE;
	}

	public function getIdColumnName() {
		return BusinessAdminDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>