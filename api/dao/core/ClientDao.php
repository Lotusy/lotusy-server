<?php
class ClientDao extends ClientDaoGenerated {

// ========================================================================================== public

    public static function getClientByAppKey($appKey) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)->where('app_key', $appKey)->find();

        return self::makeObjectFromSelectResult($res, 'ClientDao');
	}

// ======================================================================================== override

	protected function beforeInsert() {
		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
		$this->setModifiedTime($date);
	}
}
?>