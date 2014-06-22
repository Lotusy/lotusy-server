<?php
class RatingDao extends LotusyObject {

	const BUSINESSID = 'business_id';
	const USERID = 'user_id';
	const FOOD = 'food';
	const SERV = 'serv';
	const ENV = 'env';
	const OVERALL = 'overall';
	const CREATETIME = 'create_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'business';
	const TABLE = 'rating';
	const ODBNAME = 'business';


// =========================================================================================================== public

	public static function getBusinessRating($businessId) {
		$rating = new RatingDao();
		$rating->setServerAddress($businessId);

		$sql = "SELECT AVG(".RatingDao::FOOD.") as ".RatingDao::FOOD.
				", AVG(".RatingDao::SERV.") as ".RatingDao::FOOD.
				", AVG(".RatingDao::ENV.") as ".RatingDao::ENV.
				", AVG(".RatingDao::OVERALL.") as ".RatingDao::OVERALL.
				" FROM ".RatingDao::TABLE." WHERE ".
				RatingDao::BUSINESSID."=$businessId";

		$connect = DBUtil::getConn($rating);

		return DBUtil::selectData($connect, $sql);
	}

	public static function getBusinessRatingCount($businessId) {
		$rating = new RatingDao();
		$rating->setServerAddress($businessId);

		$sql = "SELECT COUNT(*) as count FROM ".RatingDao::TABLE." WHERE ".
				RatingDao::BUSINESSID."=$businessId";

		$connect = DBUtil::getConn($rating);
		$res = DBUtil::selectData($connect, $sql);

		return $res['count'];
	}

	public static function getRatingWithBusinessAndUserIds($businessId, $userId) {
		$rating = new RatingDao();
		$rating->setServerAddress($businessId);

		$sql = "SELECT * as count FROM ".RatingDao::TABLE." WHERE ".
				RatingDao::BUSINESSID."=$businessId AND ".
				RatingDao::USERID."=$userId";

		$connect = DBUtil::getConn($rating);
		$res = DBUtil::selectData($connect, $sql);

		return $rating->makeObjectFromSelectResult($res, 'RatingDao');
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[RatingDao::BUSINESSID] = 0;
		$this->var[RatingDao::USERID] = 0;
		$this->var[RatingDao::FOOD] = 0;
		$this->var[RatingDao::SERV] = 0;
		$this->var[RatingDao::ENV] = 0;
		$this->var[RatingDao::OVERALL] = 0;
		$this->var[RatingDao::CREATETIME] = gmdate('Y-m-d H:i:s');
	}

	protected function beforeInsert() {
		$sequence = $this->var[RatingDao::BUSINESSID];
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return RatingDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return RatingDao::ODBNAME;
	}

	public function getTableName() {
		return RatingDao::TABLE;
	}

	public function getIdColumnName() {
		return RatingDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>