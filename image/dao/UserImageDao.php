<?php
class UserImageDao extends LotusyDaoBase {

	const USERID = 'user_id';
	const NAME = 'name';
	const PATH = 'path';
	const ISDELETED = 'is_deleted';
	const CREATETIME = 'create_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'image_user';
	const TABLE = 'image_user';
	const ODBNAME = 'image_user';


//========================================================================================== public

	public static function getImageDaoByUserId($userId) {
		$user = new UserImageDao();
		$user->setServerAddress($userId);

		$sql = "SELECT * FROM ".UserImageDao::TABLE." WHERE ".
				UserImageDao::USERID."=$userId AND ".
				UserImageDao::ISDELETED."='N'";

		$connect = DBUtil::getConn($user);
		$res = DBUtil::selectData($connect, $sql);

		if ($res) { $user->var = $res; }
		else { $user = null; }

		return $user;
	}

	public static function getImageDaoByUserIdAndImageId($userId, $imageId) {
		$user = new UserImageDao();
		$user->setServerAddress($userId);

		$sql = "SELECT * FROM ".UserImageDao::TABLE." WHERE ".
				UserImageDao::USERID."=$userId AND ".
				UserImageDao::IDCOLUMN."=$imageId";

		$connect = DBUtil::getConn($user);
		$res = DBUtil::selectData($connect, $sql);

		if ($res) { $user->var = $res; }
		else { $user = null; }

		return $user;
	}

	public static function getImageDaoIdsByUserId($userId) {
		$user = new UserImageDao();
		$user->setServerAddress($userId);

		$sql = "SELECT ".UserImageDao::IDCOLUMN." FROM ".UserImageDao::TABLE." WHERE ".
				UserImageDao::USERID."=$userId";

		$connect = DBUtil::getConn($user);
		$rows = DBUtil::selectDataList($connect, $sql);

		$ids = array();
		foreach ($rows as $row) {
			array_push($ids, $row[UserImageDao::IDCOLUMN]);
		}

		return $ids;
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[UserImageDao::USERID] = 0;
		$this->var[UserImageDao::NAME] = '';
		$this->var[UserImageDao::PATH] = '';
		$this->var[UserImageDao::ISDELETED] = 'N';
		$this->var[UserImageDao::CREATETIME] = date('Y-m-d H:i:s');
	}

	protected function beforeInsert() {
		$sequence = $this->var[UserImageDao::USERID];
		$this->setShardId($sequence);

		$sql = "UPDATE ".UserImageDao::TABLE." SET ".UserImageDao::ISDELETED."='Y' WHERE ".
				UserImageDao::USERID."=".$this->var[UserImageDao::USERID]." AND ".
				UserImageDao::ISDELETED."='N'";
		$connect = DBUtil::getConn($this);
		DBUtil::updateData($connect, $sql);
	}

	protected function getTableName() {
		return UserImageDao::TABLE;
	}

	protected function getIdColumnName() {
		return UserImageDao::IDCOLUMN;
	}

	protected function beforeUpdate() {
		$this->var[UserImageDao::MODIFIEDTIME] = date('Y-m-d H:i:s');
	}

	public function getShardDomain() {
		return UserImageDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return UserImageDao::ODBNAME;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>