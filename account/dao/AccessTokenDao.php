<?php
class AccessTokenDao extends LotusyObject {

	const USERID = 'user_id';
	const ACCESSTOKEN = 'access_token';
	const REFRESHTOKEN = 'refresh_token';
	const EXPIRESTIME = 'expires_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'token';
	const TABLE = 'access_token';
	const ODBNAME = 'token';


//========================================================================================== public

	public static function retriveDaoByAccessToken($accessToken) {
		$token = new AccessTokenDao();
		$token->setServerAddress( Utility::hashString($accessToken) );

		$sql = "SELECT * FROM ".AccessTokenDao::TABLE." WHERE ".AccessTokenDao::ACCESSTOKEN."='$accessToken'";

		$connect = DBUtil::getConn($token);
		$res = DBUtil::selectData($connect, $sql);

		return $token->makeObjectFromSelectResult($res, 'AccessTokenDao');
	}

	public function expired() {
		return time() > $this->var[AccessTokenDao::EXPIRESTIME];
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[AccessTokenDao::USERID] = 0;
		$this->var[AccessTokenDao::ACCESSTOKEN] = Utility::generateToken();
		$this->var[AccessTokenDao::REFRESHTOKEN] = Utility::generateToken();
		$this->var[AccessTokenDao::EXPIRESTIME] = 0;
	}

	protected function beforeInsert() {
		$lookup = new LookupRefreshAccessDao();
		$lookup->var[LookupRefreshAccessDao::ACCESSTOKEN] = $this->var[AccessTokenDao::ACCESSTOKEN];
		$lookup->var[LookupRefreshAccessDao::REFRESHTOKEN] = $this->var[AccessTokenDao::REFRESHTOKEN];
		$lookup->save();

		$sequence = Utility::hashString($this->var[AccessTokenDao::ACCESSTOKEN]);
		$this->setShardId($sequence);
		$this->var[AccessTokenDao::EXPIRESTIME] = 15552000 + time();
	}

	protected function getTableName() {
		return AccessTokenDao::TABLE;
	}

	protected function getIdColumnName() {
		return AccessTokenDao::IDCOLUMN;
	}

	public function getShardDomain() {
		return AccessTokenDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return AccessTokenDao::ODBNAME;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>