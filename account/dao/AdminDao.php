<?php
class AdminDao extends AdminDaoGenerated {

// ========================================================================================== public

	public static function login($email, $password) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)->where('email', $email)->find();

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
	}
}
?>