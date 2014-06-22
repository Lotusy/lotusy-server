<?php
class LookupBusinessTwNameDao extends LotusyObject {

	const BUSINESSID = 'business_id';
	const TWNAME = 'tw_name';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_business';
	const TABLE = 'business_tw_name';
	const ODBNAME = 'lookup_business';

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupBusinessTwNameDao::BUSINESSID] = 0;
		$this->var[LookupBusinessTwNameDao::TWNAME] = '';
	}

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->var[LookupBusinessTwNameDao::TWNAME]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupBusinessTwNameDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupBusinessTwNameDao::ODBNAME;
	}

	public function getTableName() {
		return LookupBusinessTwNameDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupBusinessTwNameDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>