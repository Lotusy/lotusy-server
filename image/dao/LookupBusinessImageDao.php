<?php
class LookupBusinessImageDao extends LotusyObject {

	const BUSINESSID = 'business_id';
	const IMAGEID = 'image_id';
	const CREATETIME = 'create_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_comment_image';
	const TABLE = 'business_image';
	const ODBNAME = 'lookup_comment_image';


//========================================================================================== public

	public static function getLookupDaosByBusinessId($businessId, $start, $size) {
		$business = new LookupBusinessImageDao();
		$business->setServerAddress($businessId);

		$sql = "SELECT * FROM ".LookupBusinessImageDao::TABLE." WHERE ".
				LookupBusinessImageDao::BUSINESSID."=$businessId LIMIT $start, $size";

		$connect = DBUtil::getConn($business);
		$rows = DBUtil::selectDataList($connect, $sql);

		return $business->makeObjectsFromSelectListResult($rows, 'LookupBusinessImageDao');
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupBusinessImageDao::BUSINESSID] = 0;
		$this->var[LookupBusinessImageDao::IMAGEID] = 0;
		$this->var[LookupBusinessImageDao::CREATETIME] = gmdate('Y-m-d H:i:s');
	}

	protected function beforeInsert() {
		$sequence = $this->var[LookupBusinessImageDao::BUSINESSID];
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupBusinessImageDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupBusinessImageDao::ODBNAME;
	}

	public function getTableName() {
		return LookupBusinessImageDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupBusinessImageDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>