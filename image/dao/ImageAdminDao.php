<?php
class ImageAdminDao extends LotusyDaoBase {

	const EMAIL = 'email';
	const PASSWORD = 'password';
	const USERNAME = 'username';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'image_admin';
	const TABLE = 'admin';
	const ODBNAME = 'image_admin';

// =============================================== public function =================================================

	public static function login($email, $password) {
		$admin = new ImageAdminDao();
		$admin->setServerAddress( Utility::hashString($email) );

		$password = md5($password);

		$sql = "SELECT * FROM ".ImageAdminDao::TABLE." WHERE "
				.ImageAdminDao::EMAIL."='$email' AND "
				.ImageAdminDao::PASSWORD."='$password'";

		$connect = DBUtil::getConn($admin);
		$res = DBUtil::selectData($connect, $sql);

		return self::makeObjectFromSelectResult($res, 'ImageAdminDao');
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[ImageAdminDao::EMAIL] = '';
		$this->var[ImageAdminDao::PASSWORD] = '';
		$this->var[ImageAdminDao::USERNAME] = '';
	}

	protected function beforeInsert() {
		$this->var[ImageAdminDao::PASSWORD] = md5($this->var[ImageAdminDao::PASSWORD]);
		$sequence = Utility::hashString($this->var[ImageAdminDao::EMAIL]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return ImageAdminDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return ImageAdminDao::ODBNAME;
	}

	public function getTableName() {
		return ImageAdminDao::TABLE;
	}

	public function getIdColumnName() {
		return ImageAdminDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>