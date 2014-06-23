<?php
class LookupUserImageDao extends LotusyDaoBase {

	const USERID = 'user_id';
	const IMAGEID = 'image_id';
	const CREATETIME = 'create_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_comment_image';
	const TABLE = 'user_image';
	const ODBNAME = 'lookup_comment_image';


//========================================================================================== public

	public static function getLookupDaosByUserId($userId, $start, $size) {
		$user = new LookupUserImageDao();
		$user->setServerAddress($userId);

		$sql = "SELECT * FROM ".LookupUserImageDao::TABLE." WHERE ".
				LookupUserImageDao::USERID."=$userId LIMIT $start, $size";

		$connect = DBUtil::getConn($user);
		$rows = DBUtil::selectDataList($connect, $sql);

		return $user->makeObjectsFromSelectListResult($rows, 'LookupUserImageDao');
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupUserImageDao::USERID] = 0;
		$this->var[LookupUserImageDao::IMAGEID] = 0;
		$this->var[LookupUserImageDao::CREATETIME] = gmdate('Y-m-d H:i:s');
	}

	protected function beforeInsert() {
		$sequence = $this->var[LookupUserImageDao::USERID];
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupUserImageDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupUserImageDao::ODBNAME;
	}

	public function getTableName() {
		return LookupUserImageDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupUserImageDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>