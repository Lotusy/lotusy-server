<?php
class LookupCommentLocationDao extends LookupCommentLocationDaoGenerated {

//========================================================================================== public

	public static function getCommentIdsByLocation($lat, $lng, $radius, $start, $size, $isMiles=false) {
		$lookup = new LookupCommentLocationDao();
		$lookup->setServerAddress(Utility::hashLatLng($lat, $lng));

		$earthRadius = $isMiles ? 3959 : 6371;
		$latRadius = deg2rad($lat);

		$p1 = "cos( $latRadius ) * cos( radians(lat) ) * cos( radians(lng - $lng) )";
		$p2 = "sin( $latRadius ) * sin( radians(lat) )";

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select("comment_id, ( $earthRadius * acos( $p1 + $p2 ) ) AS distance")
						->having('distance', $radius, '<')
						->order('distance')
						->limit($start, $size)
						->findList();
		$ids = array();
		foreach ($rows as $row) {
			$ids[$row['comment_id']] = $row['distance'];
		}

		return $ids;
	}

	public static function deleteLookupDao($lat, $lng, $commentId) {
		$lookup = new LookupCommentLocationDao();
		$lookup->setServerAddress(Utility::hashLatLng($lat, $lng));

		$builder = new QueryBuilder($lookup);
		$res = $builder->delete()->where('comment_id', $commentId)->query();

		return $res;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = Utility::hashLatLng($this->getLat(), $this->getLng());
		$this->setShardId($sequence);

		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>