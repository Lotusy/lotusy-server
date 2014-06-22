<?php
class LookupBusinessUserDao extends LotusyObject {

	const BUSINESSID = 'business_id';
	const USERID = 'user_id';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_business';
	const TABLE = 'business_user';
	const ODBNAME = 'lookup_business';

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupBusinessUserDao::BUSINESSID] = 0;
		$this->var[LookupBusinessUserDao::USERID] = 0;
	}

	protected function beforeInsert() {
		$sequence = $this->var[LookupBusinessUserDao::USERID];
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupBusinessUserDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupBusinessUserDao::ODBNAME;
	}

	public function getTableName() {
		return LookupBusinessUserDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupBusinessUserDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>