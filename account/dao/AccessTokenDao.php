<?php
class AccessTokenDao extends AccessTokenDaoGenerated {

// ========================================================================================== public

	public static function retriveDaoByAccessToken($accessToken) {
		$token = new AccessTokenDao();
		$sequence = Utility::hashString($accessToken);
		$token->setServerAddress( $sequence );

		$builder = new QueryBuilder($token);
		$res = $builder->select('*')->where('access_token', $accessToken)->find();

		return self::makeObjectFromSelectResult($res, 'AccessTokenDao');
	}

	public function expired() {
		return time() > $this->getExpiresTime();
	}

// ======================================================================================== override

	protected function beforeInsert() {
		$lookup = new LookupRefreshAccessDao();
		$lookup->setAccessToken($this->getAccessToken());
		$lookup->setRefreshToken($this->getRefreshToken());
		$lookup->save();

		$sequence = Utility::hashString($this->getAccessToken());
		$this->setShardId($sequence);
		$this->setExpiresTime(15552000+time());
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>