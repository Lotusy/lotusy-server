<?php
class LookupBusinessImageDao extends LookupBusinessImageDaoGenerated {

//========================================================================================== public

	public static function getLookupDaosByBusinessId($businessId, $start, $size) {
		$business = new LookupBusinessImageDao();
		$business->setServerAddress($businessId);

		$builder = new QueryBuilder($business);
		$res = $builder->select('*')
						->where('business_id', $businessId)
						->limit($start, $size)
						->findList();

		return self::makeObjectsFromSelectListResult($res, 'LookupBusinessImageDao');
	}

	public static function isBusinessImageExist($businessId, $imageId) {
		$lookup = new LookupBusinessImageDao();
		$lookup->setServerAddress($businessId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('COUNT(*) as count')->where('business_id', $businessId)->find();

		return $res['count']>0;
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