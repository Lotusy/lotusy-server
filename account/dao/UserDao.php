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
		$userId = LookupUserExternalDao::getUniqueUserIdFromExternalRef($externalType, $externalRef);

		$user = null;
		if ($userId>0) {
			$user = new UserDao($userId);
		}

		return $user;
	}

// ======================================================================================== override

	protected function beforeInsert() {
		$lookupExternalRef = new LookupUserExternalDao();
		$lookupExternalRef->setReference($this->getExternalRef());
		$lookupExternalRef->setType($this->getExternalType());
		$lookupExternalRef->setUserId($this->getId());
		$lookupExternalRef->save();

		$lookupUsername = new LookupUserNicknameDao();
		$lookupUsername->setNickname($this->getNickname());
		$lookupUsername->setUserId($this->getId());
		$lookupUsername->save();

		$this->setSuperuser('N');
		$this->setBlocked('N');
		$this->setLastLogin(date('Y-m-d H:i:s'));
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>