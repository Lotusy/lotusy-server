<?php
class LookupCommentLocationDao extends LotusyDaoBase {

	const COMMENTID = 'comment_id';
	const LAT = 'lat';
	const LNG = 'lng';
	const CREATETIME = 'create_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'lookup_comment';
	const TABLE = 'comment_location';
	const ODBNAME = 'lookup_comment';

//========================================================================================== public

	public static function getCommentIdsByLocation($lat, $lng, $radius, $start, $size, $isMiles=false) {
		$lookup = new LookupCommentLocationDao();
		$lookup->setServerAddress(Utility::hashLatLng($lat, $lng));

		$earthRadius = $isMiles ? 3959 : 6371;
		$latRadius = deg2rad($lat);
		$lngRadius = deg2rad($lng);

		$p1 = "cos( $latRadius ) * cos( radians(lat) ) * cos( radians(lng) - $lngRadius )";
		$p2 = "sin( $latRadius ) * sin( radians(lat) )";

		$sql = "SELECT ".LookupCommentLocationDao::COMMENTID.", ( $earthRadius * acos( $p1 + $p2 ) ) AS distance FROM ".
				LookupCommentLocationDao::TABLE." HAVING distance < $radius ORDER BY distance LIMIT $start, $size";
				
		$connect = DBUtil::getConn($lookup);

		return DBUtil::selectDataList($connect, $sql);
	}

	public static function deleteLookupDao($lat, $lng, $commentId) {
		$lookup = new LookupCommentLocationDao();
		$lookup->setServerAddress(Utility::hashLatLng($lat, $lng));

		$sql = "DELETE FROM ".LookupCommentLocationDao::TABLE." WHERE ".LookupCommentLocationDao::COMMENTID."=$commentId";

		$connect = DBUtil::getConn($lookup);

		return DBUtil::deleteData($connect, $sql);
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupCommentLocationDao::COMMENTID] = 0;
		$this->var[LookupCommentLocationDao::LAT] = 0;
		$this->var[LookupCommentLocationDao::LNG] = 0;
		$this->var[LookupCommentLocationDao::CREATETIME] = gmdate('Y-m-d H:i:s');
	}

	protected function beforeInsert() {
		$sequence = Utility::hashLatLng($this->var[LookupCommentBusinessDao::LAT], $this->var[LookupCommentBusinessDao::LNG]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupCommentLocationDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return LookupCommentLocationDao::ODBNAME;
	}

	public function getTableName() {
		return LookupCommentLocationDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupCommentLocationDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>