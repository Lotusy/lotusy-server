<?php
class UserDao extends UserDaoGenerated {

	public static $TYPEARRAY = array(
		'facebook' => 1,
		'weibo' => 2
	);

	public static $TYPEARRAYREV = array(
		1 => 'facebook',
		2 => 'weibo'
	);

// ========================================================================================== public

	public static function getUserDaoByExternalRef($externalType, $externalRef) {
		$userId = self::getUniqueUserIdFromExternalRef($externalType, $externalRef);

		$user = null;
		if ($userId>0) {
			$user = new UserDao($userId);
		}

		return $user;
	}

	public static function getUserIdsFromExternalRef($externalType, $externalRef) {
		if (!isset(self::$TYPEARRAY[$externalType])) {
			return array();
		}

		$type = self::$TYPEARRAY[$externalType];

		$builder = new QueryMaster();
		$res = $builder->select('id', self::$table)
						->where('external_ref', $externalRef)
						->where('external_type', $type)
						->findList();

		$atReturn = array();
		foreach ($res as $row) {
			array_push($atReturn, $row['id']);
		}

		return $atReturn;
	}

	public static function getUniqueUserIdFromExternalRef($externalType, $externalRef) {
		if (!isset(UserDao::$TYPEARRAY[$externalType])) {
			return 0;
		}

		$type = UserDao::$TYPEARRAY[$externalType];

		$builder = new QueryMaster();
		$res = $builder->select('id', self::$table)
						->where('external_ref', $externalRef)
						->where('external_type', $type)
					   ->find();

		if (isset($res) && $res) {
			return $res['id'];
		}

		return 0;
	}

	public static function isExternalRefExist($externalType, $externalRef) {
		if (!isset(UserDao::$TYPEARRAY[$externalType])) {
			return false;
		}

		$type = UserDao::$TYPEARRAY[$externalType];

		$builder = new QueryMaster();
		$res = $builder->select('COUNT(*) as count', self::$table)
						->where('external_ref', $externalRef)
						->where('external_type', $type)
						->find();

		return isset($res) && isset($res['count']) && $res['count']>0;
	}

	public static function getUserIdsFromNickName($nickname) {
		$builder = new QueryMaster();
		$res = $builder->select('id', self::$table)->where('nickname', '%'.$nickname.'%', 'LIKE')->findList();

		$atReturn = array();
		foreach ($res as $row) {
			array_push($atReturn, $row['id']);
		}

		return $atReturn;
	}

// ======================================================================================== override

	protected function beforeInsert() {
		$this->setSuperuser('N');
		$this->setBlocked('N');
		$this->setLastLogin(date('Y-m-d H:i:s'));
	}
}
?>