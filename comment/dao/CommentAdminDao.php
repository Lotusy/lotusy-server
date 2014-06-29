<?php
class CommentAdminDao extends CommentAdminDaoGenerated {

// =============================================== public function =================================================

	public static function login($email, $password) {
		$admin = new CommentAdminDao();
		$admin->setServerAddress( Utility::hashString($email) );

		$password = md5($password);

		$sql = "SELECT * FROM ".CommentAdminDao::TABLE." WHERE "
				.CommentAdminDao::EMAIL."='$email' AND "
				.CommentAdminDao::PASSWORD."='$password'";

		$connect = DBUtil::getConn($admin);
		$res = DBUtil::selectData($connect, $sql);

		return self::makeObjectFromSelectResult($res, 'CommentAdminDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$this->var[CommentAdminDao::PASSWORD] = md5($this->var[CommentAdminDao::PASSWORD]);
		$sequence = Utility::hashString($this->var[CommentAdminDao::EMAIL]);
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>