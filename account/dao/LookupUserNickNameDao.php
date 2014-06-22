<?php
class LookupUserNickNameDao extends LotusyObject {

	const NICKNAME = 'nickname';
	const USERID = 'user_id';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_account';
	const TABLE = 'user_nickname';
	const ODBNAME = 'lookup_account';


//========================================================================================== public

	public static function getUserIdsFromNickName($nickname) {
		$lookup = new LookupUserNickNameDao();
		$lookup->setServerAddress( Utility::hashString($nickname) );

		$sql = "SELECT ".LookupUserNickNameDao::USERID." FROM ".LookupUserNickNameDao::TABLE." WHERE "
				.LookupUserNickNameDao::NICKNAME." LIKE '%$nickname%'";

		$connect = DBUtil::getConn($lookup);
		$rows = DBUtil::selectDataList($connect, $sql);

		$atReturn = array();
		foreach ($rows as $row) {
			array_push($atReturn, $row[LookupUserNickNameDao::USERID]);
		}

		return $atReturn;
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupUserNickNameDao::NICKNAME] = '';
		$this->var[LookupUserNickNameDao::USERID] = 0;
	}

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->var[LookupUserNickNameDao::NICKNAME]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupUserNickNameDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupUserNickNameDao::ODBNAME;
	}

	public function getTableName() {
		return LookupUserNickNameDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupUserNickNameDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>