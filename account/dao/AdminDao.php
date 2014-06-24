<?php
class AdminDao extends AdminDaoGenerated {

// ========================================================================================== public

	public static function login($email, $password) {
		$admin = new AccountAdminDao();
		$admin->setServerAddress( Utility::hashString($email) );

		$builder = new QueryBuilder($admin);
		$res = $builder->select('*')->where('email', $email)->find();

		$admin = self::makeObjectFromSelectResult($res, 'AccountAdminDao');

		$password = md5($password);
		$admin_passwd = $admin->getPassword();

		if ($password!=$admin_passwd) {
			$admin = null;
		}

		return $admin;
	}

// ======================================================================================== override

	protected function beforeInsert() {
		$passwd = $this->getPassword();
		$this->setPassword(md5($passwd));

		$sequence = Utility::hashString($this->getEmail());
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>