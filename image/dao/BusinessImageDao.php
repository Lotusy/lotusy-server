<?php
class BusinessImageDao extends BusinessImageDaoGenerated {

//========================================================================================== public

	public static function getImagesByBusinessId($businessId) {
		$business = new BusinessImageDao();
		$business->setServerAddress($businessId);

		$builder = new QueryBuilder($business);
		$res = $builder->select('*')
					   ->where('business_id', $businessId)
					   ->find();

		return self::makeObjectFromSelectResult($res, 'BusinessImageDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getBusinessId();
		$this->setShardId($sequence);

		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function beforeUpdate() {
		$sequence = $this->getBusinessId();
		$this->setServerAddress($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>