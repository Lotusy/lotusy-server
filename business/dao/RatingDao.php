<?php
class RatingDao extends RatingDaoGenerated {

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

		return self::makeObjectFromSelectResult($res, 'RatingDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->var[RatingDao::BUSINESSID];
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>