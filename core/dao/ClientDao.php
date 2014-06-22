<?php
class ClientDao extends LotusyObject {

	const APPKEY = 'app_key';
	const NAME = 'name';
	const SCOPE = 'scope';
	const CREATETIME = 'create_time';
	const MODIFIEDTIME = 'modified_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'client';
	const TABLE = 'client';
	const ODBNAME = 'client';


//========================================================================================== public

	/**
	 * Enter description here ...
	 * @param unknown_type $appKey
	 */
	public function getClientByAppKey($appKey) {
		$sql = "SELECT * FROM ".ClientDao::TABLE." WHERE ".ClientDao::APPKEY."='$appKey'";

		$connect = DBUtil::getConn($this);
		$res = DBUtil::selectData($connect, $sql);

		return $this->makeObjectFromSelectResult($res, 'ClientDao');
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[ClientDao::IDCOLUMN] = 0;
		$this->var[ClientDao::APPKEY] = '';
		$this->var[ClientDao::NAME] = '';
		$this->var[ClientDao::SCOPE] = 'account+business+comment+image';

		$datetime = date('Y-m-d H:i:s');
		$this->var[ClientDao::CREATETIME] = $datetime;
		$this->var[ClientDao::MODIFIEDTIME] = $datetime;
	}

	protected function getTableName() {
		return ClientDao::TABLE;
	}

	protected function getIdColumnName() {
		return ClientDao::IDCOLUMN;
	}

	protected function actionBeforeUpdate() {
		$this->var[ClientDao::MODIFIEDTIME] = date('Y-m-d H:i:s');
	}

	public function getShardDomain() {
		return ClientDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return ClientDao::ODBNAME;
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>