<?php
class UserDao extends UserDaoGenerated {

	const EXTERNALTYPE = 'external_type';
	const EXTERNALREF = 'external_ref';
	const USERNAME = 'username';
	const NICKNAME = 'nickname';
	const PROFILEPIC = 'profile_pic';
	const DESCRIPTION = 'description';
	const SUPERUSER = 'superuser';
	const BLOCKED = 'blocked';
	const LASTLOGIN = 'last_login';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'user';
	const TABLE = 'user';
	const ODBNAME = 'user';

	public static $TYPEARRAY = array(
		'facebook' => 1,
		'wechat' => 2
	);

	public static $TYPEARRAYREV = array(
		1 => 'facebook',
		2 => 'wechat'
	);

// =============================================== public function =================================================

	public static function getUserDaoByExternalRef($externalType, $externalRef) {
		$userIds = LookupUserExternalRefDao::getUserIdsFromExternalRef($externalType, $externalRef);

		$user = null;
		if (sizeof($userIds)==1) {
			$user =  new UserDao($userIds[0]);
		}

		return $user;
	}

// ============================================ override functions ==================================================

	protected function init() {
		global $base_host;
		$this->var[UserDao::EXTERNALTYPE] = 0;
		$this->var[UserDao::EXTERNALREF] = '';
		$this->var[UserDao::USERNAME] = '';
		$this->var[UserDao::NICKNAME] = '';
		$this->var[UserDao::PROFILEPIC] = $base_host.'/portal/img/default_profile.png';
		$this->var[UserDao::DESCRIPTION] = '';
		$this->var[UserDao::SUPERUSER] = 'N';
		$this->var[UserDao::BLOCKED] = 'N';
		$this->var[UserDao::LASTLOGIN] = gmdate('Y-m-d H:i:s');
	}

	protected function beforeInsert() {
		$lookupExternalRef = new LookupUserExternalRefDao();
		$lookupExternalRef->var[LookupUserExternalRefDao::EXTERNALTYPE] = $this->var[UserDao::EXTERNALTYPE];
		$lookupExternalRef->var[LookupUserExternalRefDao::EXTERNALREF] = $this->var[UserDao::EXTERNALREF];
		$lookupExternalRef->var[LookupUserExternalRefDao::USERID] = $this->var[UserDao::IDCOLUMN];
		$lookupExternalRef->save();

		$lookupUsername = new LookupUserNickNameDao();
		$lookupUsername->var[LookupUserNickNameDao::NICKNAME] = $this->var[UserDao::NICKNAME];
		$lookupUsername->var[LookupUserNickNameDao::USERID] = $this->var[UserDao::IDCOLUMN];
		$lookupUsername->save();
	}

	public function getShardDomain() {
		return UserDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return UserDao::ODBNAME;
	}

	public function getTableName() {
		return UserDao::TABLE;
	}

	public function getIdColumnName() {
		return UserDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>