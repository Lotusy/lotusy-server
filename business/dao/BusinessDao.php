<?php
class BusinessDao extends BusinessDaoGenerated {

	public static $TYPEARRAY = array(
		'yelp' => 1,
		'dianping' => 2
	);

	public static $TYPEARRAYREV = array(
		1 => 'yelp',
		2 => 'dianping'
	);

// =========================================================================================================== public

	public static function getBusinessIdsByName($name, $field) {
		$lookup->setServerAddress( Utility::hashString($name) );

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select($bid)->where($column, '%'.$name.'%', 'LIKE')->findList();

		$atReturn = array();
		foreach ($rows as $row) {
			array_push($atReturn, $row[$bid]);
		}

		return $atReturn;
	}

	public static function isEnNameExist($name) {
		$builder = new QueryBuilder($lookup);
		$res = $builder->select('COUNT(*) as count')->where('en_name', $name)->find();

		return $res['count']>0;
	}

	public static function isExternalIdExist($externalId, $externalType) {
		$lookup = new LookupBusinessExternalDao();
		$lookup->setServerAddress($externalId);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('external_type')->where('external_id', $externalId)->findList();

		foreach ($rows as $row) {
			if ($row['external_type']==$externalType) {
				return true;
			}
		}

		return false;
	}
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
		$this->setVerified('N');
	}

	public function toArray() {
		$atReturn = parent::toArray(array('hours'));
		$atReturn['hours'] = json_decode($this->getHours(), true);
		return $atReturn;
	}
}
?>