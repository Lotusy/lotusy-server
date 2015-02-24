<?php
class BusinessImageDao extends ImageBusinessDaoGenerated {

//========================================================================================== public

	public static function getImagesByBusinessId($businessId) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
					   ->where('business_id', $businessId)
					   ->find();

		return self::makeObjectFromSelectResult($res, 'BusinessImageDao');
	}

	public static function getLookupDaosByBusinessId($businessId, $start, $size) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
						->where('business_id', $businessId)
						->limit($start, $size)
						->findList();

		return self::makeObjectsFromSelectListResult($res, 'LookupBusinessImageDao');
	}

	public static function isBusinessImageExist($businessId, $imageId) {
		$builder = new QueryMaster();
		$res = $builder->select('COUNT(*) as count', self::$table)->where('business_id', $businessId)->find();

		return $res['count']>0;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}
}
?>