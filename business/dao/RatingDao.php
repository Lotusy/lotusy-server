<?php
class RatingDao extends RatingDaoGenerated {

// =========================================================================================================== public

	public static function getBusinessRating($businessId) {
		$rating = new RatingDao();
		$rating->setServerAddress($businessId);

		$builder = new QueryBuilder($rating);
		$res = $builder->select('AVG(food) as food, AVG(serv) as serv, AVG(env) as env, AVG(overall) as overall')
					   ->where('business_id', $businessId)
					   ->find();

		return $res;
	}

	public static function getBusinessRatingCount($businessId) {
		$rating = new RatingDao();
		$rating->setServerAddress($businessId);

		$builder = new QueryBuilder($rating);
		$res = $builder->select('COUNT(*) as count')
					   ->where('business_id', $businessId)
					   ->find();

		return $res['count'];
	}

	public static function getRatingWithBusinessAndUserIds($businessId, $userId) {
		$rating = new RatingDao();
		$rating->setServerAddress($businessId);

		$builder = new QueryBuilder($rating);
		$res = $builder->select('*')
					   ->where('business_id', $businessId)
					   ->where('user_id', $userId)
					   ->order('id', true)
					   ->find();

		return self::makeObjectFromSelectResult($res, 'RatingDao');
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