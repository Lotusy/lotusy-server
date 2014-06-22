<?php
class LookupBusinessEnNameDao extends LotusyObject {

	const BUSINESSID = 'business_id';
	const ENNAME = 'en_name';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_business';
	const TABLE = 'business_en_name';
	const ODBNAME = 'lookup_business';

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupBusinessEnNameDao::BUSINESSID] = 0;
		$this->var[LookupBusinessEnNameDao::ENNAME] = '';
	}

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->var[LookupBusinessEnNameDao::ENNAME]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupBusinessEnNameDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupBusinessEnNameDao::ODBNAME;
	}

	public function getTableName() {
		return LookupBusinessEnNameDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupBusinessEnNameDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>