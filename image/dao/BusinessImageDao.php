<?php
class BusinessImageDao extends LotusyObject {

	const BUSINESSID = 'business_id';
	const NAME = 'name';
	const PATH = 'path';
	const CREATETIME = 'create_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'image_business';
	const TABLE = 'image_business';
	const ODBNAME = 'image_business';


//========================================================================================== public

	public static function getImagesByBusinessId($businessId) {
		$business = new BusinessImageDao();
		$business->setServerAddress($businessId);

		$sql = "SELECT * FROM ".BusinessImageDao::TABLE." WHERE ".
				BusinessImageDao::BUSINESSID."=$businessId";

		$connect = DBUtil::getConn($business);
		$res = DBUtil::selectData($connect, $sql);

		if ($res) { $business->var = $res; }
		else { $business = null; }

		return $business;
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[BusinessImageDao::BUSINESSID] = 0;
		$this->var[BusinessImageDao::NAME] = '';
		$this->var[BusinessImageDao::PATH] = '';
		$this->var[BusinessImageDao::CREATETIME] = date('Y-m-d H:i:s');
	}

	protected function beforeInsert() {
		$sequence = $this->var[BusinessImageDao::BUSINESSID];
		$this->setShardId($sequence);
	}

	protected function getTableName() {
		return BusinessImageDao::TABLE;
	}

	protected function getIdColumnName() {
		return BusinessImageDao::IDCOLUMN;
	}

	protected function actionBeforeUpdate() {
		$this->var[BusinessImageDao::MODIFIEDTIME] = date('Y-m-d H:i:s');
	}

	public function getShardDomain() {
		return BusinessImageDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return BusinessImageDao::ODBNAME;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>