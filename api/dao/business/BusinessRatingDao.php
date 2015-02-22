<?php
class BusinessRatingDao extends BusinessRatingDaoGenerated {

// =========================================================================================================== public

	public static function getBusinessRating($businessId) {
		$builder = new QueryMaster();
		$res = $builder->select('AVG(food) as food, AVG(serv) as serv, AVG(env) as env, AVG(overall) as overall', self::$table)
					   ->where('business_id', $businessId)
					   ->find();
	
		if (empty($res['food'])) { $res['food'] = 0; }
		if (empty($res['serv'])) { $res['serv'] = 0; }
		if (empty($res['env'])) { $res['env'] = 0; }
		if (empty($res['overall'])) { $res['overall'] = 0; }

		return $res;
	}

	public static function getBusinessRatingCount($businessId) {
		$builder = new QueryMaster();
		$res = $builder->select('COUNT(*) as count', self::$table)
					   ->where('business_id', $businessId)
					   ->find();

		return $res['count'];
	}

	public static function getRatingWithBusinessAndUserIds($businessId, $userId) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
					   ->where('business_id', $businessId)
					   ->where('user_id', $userId)
					   ->order('id', true)
					   ->find();

		return self::makeObjectFromSelectResult($res, 'BusinessRatingDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}
}
?>