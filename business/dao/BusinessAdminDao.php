<?php
class BusinessAdminDao extends BusinessAdminDaoGenerated {

// =============================================== public function =================================================

	public static function login($email, $password) {
		$admin = new BusinessAdminDao();
		$admin->setServerAddress( Utility::hashString($email) );

		$password = md5($password);

		$builder = new QueryBuilder($admin);
		$res = $builder->select('*')->where('email', $email)->where('password', $password)->find();

		return self::makeObjectFromSelectResult($res, 'BusinessAdminDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$this->setPassword(md5($this->getPassword()));
		$sequence = Utility::hashString($this->getEmail());
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>