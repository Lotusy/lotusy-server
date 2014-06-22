<?php
class LookupBusinessLocationDao extends LotusyObject {

	const BUSINESSID = 'business_id';
	const LAT = 'lat';
	const LNG = 'lng';
	const VERIFIED = 'verified';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_business';
	const TABLE = 'business_location';
	const ODBNAME = 'lookup_business';

// =========================================================================================================== public

	public static function getLookupWithBusiness($business) {
		$lookup = new LookupBusinessLocationDao();
		$lookup->setServerAddress(Utility::hashLatLng($business->var[BusinessDao::LAT], $business->var[BusinessDao::LNG]));

		$sql = "select * FROM ".LookupBusinessLocationDao::TABLE." WHERE "
				.LookupBusinessLocationDao::BUSINESSID."=".$business->var[BusinessDao::IDCOLUMN];

		$connect = DBUtil::getConn($lookup);
		$res = DBUtil::selectData($connect, $sql);

		return $lookup->makeObjectFromSelectResult($res, 'LookupBusinessLocationDao');
	}


	public static function getBusinessIdsWithin($lat, $lng, $radius, $start, $size, $isMiles=false) {
		$lookup = new LookupBusinessLocationDao();
		$lookup->setServerAddress(Utility::hashLatLng($lat, $lng));

		$earthRadius = $isMiles ? 3959 : 6371;
		$latRadius = deg2rad($lat);
		$lngRadius = deg2rad($lng);

		$p1 = "cos( $latRadius ) * cos( radians(lat) ) * cos( radians(lng) - $lngRadius )";
		$p2 = "sin( $latRadius ) * sin( radians(lat) )";

		$sql = "SELECT ".LookupBusinessLocationDao::BUSINESSID.", ( $earthRadius * acos( $p1 + $p2 ) ) AS distance FROM ".
				LookupBusinessLocationDao::TABLE." HAVING distance < $radius ORDER BY distance LIMIT $start, $size";

		$connect = DBUtil::getConn($lookup);

		return DBUtil::selectDataList($connect, $sql);
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupBusinessLocationDao::BUSINESSID] = 0;
		$this->var[LookupBusinessLocationDao::LAT] = 0;
		$this->var[LookupBusinessLocationDao::LNG] = 0;
		$this->var[LookupBusinessLocationDao::VERIFIED] = 'N';
	}

	protected function beforeInsert() {
		$sequence = Utility::hashLatLng($this->var[LookupBusinessLocationDao::LAT], $this->var[LookupBusinessLocationDao::LNG]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupBusinessLocationDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupBusinessLocationDao::ODBNAME;
	}

	public function getTableName() {
		return LookupBusinessLocationDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupBusinessLocationDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>