<?php
class LookupUserExternalRefDao extends LotusyObject {

	const EXTERNALTYPE = 'external_type';
	const EXTERNALREF = 'external_ref';
	const USERID = 'user_id';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_account';
	const TABLE = 'user_external';
	const ODBNAME = 'lookup_account';


//========================================================================================== public

	public static function getUserIdsFromExternalRef($externalType, $externalRef) {
		$lookup = new LookupUserExternalRefDao();
		$lookup->setServerAddress( Utility::hashString($externalType.$externalRef) );

		$sql = "SELECT ".LookupUserExternalRefDao::USERID." FROM ".LookupUserExternalRefDao::TABLE." WHERE "
				.LookupUserExternalRefDao::EXTERNALTYPE."=$externalType AND "
				.LookupUserExternalRefDao::EXTERNALREF." LIKE '$externalRef%'";

		$connect = DBUtil::getConn($lookup);
		$rows = DBUtil::selectDataList($connect, $sql);

		$atReturn = array();
		foreach ($rows as $row) {
			array_push($atReturn, $row[LookupUserExternalRefDao::USERID]);
		}

		return $atReturn;
	}

	public function isExternalRefExist($externalType, $externalRef) {
		$this->setServerAddress( Utility::hashString($externalType.$externalRef) );

		$sql = "SELECT COUNT(*) as count FROM ".LookupUserExternalRefDao::TABLE." WHERE "
				.LookupUserExternalRefDao::EXTERNALTYPE."=$externalType AND "
				.LookupUserExternalRefDao::EXTERNALREF."='$externalRef'";

		$connect = DBUtil::getConn($this);
		$res = DBUtil::selectData($connect, $sql);

		return isset($res) && isset($res['count']) && $res['count']>0;
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupUserExternalRefDao::EXTERNALTYPE] = 0;
		$this->var[LookupUserExternalRefDao::EXTERNALREF] = '';
		$this->var[LookupUserExternalRefDao::USERID] = 0;
	}

	protected function beforeInsert() {
		$hashStr = $this->var[LookupUserExternalRefDao::EXTERNALTYPE].$this->var[LookupUserExternalRefDao::EXTERNALREF];
		$sequence = Utility::hashString($hashStr);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupUserExternalRefDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupUserExternalRefDao::ODBNAME;
	}

	public function getTableName() {
		return LookupUserExternalRefDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupUserExternalRefDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>