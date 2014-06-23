<?php
class LookupRefreshAccessDao extends LotusyDaoBase {

	const ACCESSTOKEN = 'access_token';
	const REFRESHTOKEN = 'refresh_token';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_token';
	const TABLE = 'refresh_access';
	const ODBNAME = 'lookup_token';

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupRefreshAccessDao::ACCESSTOKEN] = '';
		$this->var[LookupRefreshAccessDao::REFRESHTOKEN] = '';
	}

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->var[LookupRefreshAccessDao::REFRESHTOKEN]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupRefreshAccessDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupRefreshAccessDao::ODBNAME;
	}

	public function getTableName() {
		return LookupRefreshAccessDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupRefreshAccessDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>