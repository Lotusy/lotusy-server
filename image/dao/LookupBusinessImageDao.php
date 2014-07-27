<?php
class LookupBusinessImageDao extends LookupBusinessImageDaoGenerated {

//========================================================================================== public

	public static function getLookupDaosByBusinessId($businessId, $start, $size) {
		$business = new LookupBusinessImageDao();
		$business->setServerAddress($businessId);

		$builder = new QueryBuilder($business);
		$rows = $builder->select('*')
						->where('business_id', $businessId)
						->limit($start, $size)
						->findList();

		return self::makeObjectsFromSelectListResult($rows, 'LookupBusinessImageDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getBusinessId();
		$this->setShardId($sequence);

		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>