<?php
class LookupBusinessZhNameDao extends LotusyDaoBase {

	const BUSINESSID = 'business_id';
	const ZHNAME = 'zh_name';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_business';
	const TABLE = 'business_zh_name';
	const ODBNAME = 'lookup_business';

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupBusinessZhNameDao::BUSINESSID] = 0;
		$this->var[LookupBusinessZhNameDao::ZHNAME] = '';
	}

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->var[LookupBusinessZhNameDao::ZHNAME]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupBusinessZhNameDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupBusinessZhNameDao::ODBNAME;
	}

	public function getTableName() {
		return LookupBusinessZhNameDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupBusinessZhNameDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>