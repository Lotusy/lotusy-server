<?php
class ClientDao extends ClientDaoGenerated {

// ========================================================================================== public

    public static function getClientByAppKey($appKey) {
    	$client = new ClientDao();
		$sequence = Utility::hashString($appKey);
		$client->setServerAddress($sequence);

		$build = new QueryBuilder($client);
		$res = $build->select('*')->where('app_key', $appKey)->find();

        return self::makeObjectFromSelectResult($res, 'ClientDao');
	}

// ======================================================================================== override

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->getAppKey());
		$this->setShardId($sequence);

		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
		$this->setModifiedTime($date);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>