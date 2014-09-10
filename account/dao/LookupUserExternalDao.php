<?php
class LookupUserExternalDao extends LookupUserExternalDaoGenerated {

// ========================================================================================== public

	public static function getUserIdsFromExternalRef($externalType, $externalRef) {
		if (!isset(UserDao::$TYPEARRAY[$externalType])) {
			return array();
		}

		$type = UserDao::$TYPEARRAY[$externalType];

		$lookup = new LookupUserExternalDao();
		$lookup->setServerAddress( Utility::hashString($type.$externalRef) );

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('user_id')
						->where('reference', $externalRef)
						->where('type', $type)
						->findList();

		$atReturn = array();
		foreach ($rows as $row) {
			array_push($atReturn, $row['user_id']);
		}

		return $atReturn;
	}

	public static function getUniqueUserIdFromExternalRef($externalType, $externalRef) {
		if (!isset(UserDao::$TYPEARRAY[$externalType])) {
			return 0;
		}

		$type = UserDao::$TYPEARRAY[$externalType];

		$lookup = new LookupUserExternalDao();
		$lookup->setServerAddress( Utility::hashString($type.$externalRef) );

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('user_id')
					   ->where('reference', $externalRef)
					   ->where('type', $type)
					   ->find();

		if (isset($res) && $res) {
			return $res['user_id'];
		}

		return 0;
	}

	public function isExternalRefExist($externalType, $externalRef) {
		if (!isset(UserDao::$TYPEARRAY[$externalType])) {
			return false;
		}

		$type = UserDao::$TYPEARRAY[$externalType];

		$this->setServerAddress( Utility::hashString($type.$externalRef) );

		$builder = new QueryBuilder($this);
		$res = $builder->select('COUNT(*) as count')
						->where('reference', $externalRef)
						->where('type', $type)
						->find();

		return isset($res) && isset($res['count']) && $res['count']>0;
	}

// ======================================================================================== override

	protected function beforeInsert() {
		$type = $this->getType();
		$reference = $this->getReference();

		$hashStr = $type.$reference;

		$sequence = Utility::hashString($hashStr);
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>