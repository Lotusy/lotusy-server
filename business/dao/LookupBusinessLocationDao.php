<?php
class LookupBusinessLocationDao extends LookupBusinessLocationDaoGenerated {

// =========================================================================================================== public

	public static function getLookupWithBusiness($business) {
		$lookup = new LookupBusinessLocationDao();
		$lookup->setServerAddress(Utility::hashLatLng($business->getLat(), $business->getLng()));

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('*')->where('business_id', $business->getId())->find();

		return self::makeObjectFromSelectResult($res, 'LookupBusinessLocationDao');
	}


	public static function getBusinessIdsWithin($lat, $lng, $radius, $start, $size, $isMiles=false) {
		$lookup = new LookupBusinessLocationDao();
		$lookup->setServerAddress(Utility::hashLatLng($lat, $lng));

		$earthRadius = $isMiles ? 3959 : 6371;
		$latRadius = deg2rad($lat);

		$p1 = "cos( $latRadius ) * cos( radians(lat) ) * cos( radians(lng - $lng) )";
		$p2 = "sin( $latRadius ) * sin( radians(lat) )";

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select("business_id, ( $earthRadius * acos( $p1 + $p2 ) ) AS distance")
						->having('distance', $radius, '<')
						->order('distance')
						->limit($start, $size)
						->findList();

		return $rows;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = Utility::hashLatLng($this->getLat(), $this->getLng());
		$this->setShardId($sequence);
	}

	protected function beforeUpdate() {
		$sequence = Utility::hashLatLng($this->getLat(), $this->getLng());
		$this->setServerAddress($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>