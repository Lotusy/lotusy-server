<?php
class CommentDao extends CommentDaoGenerated {

//========================================================================================== public

	public static function getCommentsByLocation($lat, $lng, $radius, $start, $size, $isMiles=false) {
		$earthRadius = $isMiles ? 3959 : 6371;
		$latRadius = deg2rad($lat);

		$p1 = "cos( $latRadius ) * cos( radians(lat) ) * cos( radians(lng - $lng) )";
		$p2 = "sin( $latRadius ) * sin( radians(lat) )";
		
        $fields = 'id, business_id, user_id, dish_id, lat, lng, message, like_count, dislike_count, is_deleted, create_time';

		$builder = new QueryMaster();
		$res = $builder->select("$fields, ( $earthRadius * acos( $p1 + $p2 ) ) AS distance", self::$table)
						->having('distance', $radius, '<')
						->order('distance')
						->limit($start, $size)
						->findList();

		$comments = array();

		foreach ($res as $row) {
			$distance = $row['distance'];
			unset($row['distance']);
			$comment = self::makeObjectFromSelectResult($row, 'CommentDao');
			$comments[$distance] = $comment;
		}

		return $comments;
	}

	public static function getCommentsByBusinessId($businessId, $start, $size) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
						->where('business_id', $businessId)
						->limit($start, $size)
						->findList();

		$comments = self::makeObjectsFromSelectListResult($res, 'CommentDao');

		return $comments;
	}

	public static function getCommentsByUserId($userId, $start, $size) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
						->where('user_id', $userId)
						->limit($start, $size)
						->findList();

		$comments = self::makeObjectsFromSelectListResult($res, 'CommentDao');

		return $comments;
	}

	public static function getCommentsByDishId($dishId, $start, $size) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
						->where('dish_id', $dishId)
						->limit($start, $size)
						->findList();

		$comments = self::makeObjectsFromSelectListResult($res, 'CommentDao');

		return $comments;
	}

	public static function getCommentCountByBusinessId($businessId) {
		$builder = new QueryMaster();
		$res = $builder->select('COUNT(*) as count', self::$table)
					   ->where('business_id', $businessId)
					   ->find();

		return $res['count'];
	}

	public static function getCommentCountByDishId($dishId) {
		$builder = new QueryMaster();
		$res = $builder->select('COUNT(*) as count', self::$table)
					   ->where('dish_id', $dishId)
					   ->find();

		return $res['count'];
	}

	public static function getUserDishComment($dishId, $userId) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
					   ->where('dish_id', $dishId)
					   ->where('user_id', $userId)
					   ->order('id', true)
					   ->find();

		return self::makeObjectFromSelectResult($res, 'CommentDao');
	}

	public function like() {
		$builder = new QueryMaster();
		$set = array('like_count'=>'like_count+1');
		$res = $builder->update($set, self::$table, true)->where('id', $this->getId())->query();

		if ($res) {
			$this->setLikeCount($this->getLikeCount()+1);
		}

		return $res;
	}

	public function dislike() {
		$builder = new QueryMaster();
		$set = array('like_count'=>'like_count-1');
		$res = $builder->update($set, self::$table, true)->where('id', $this->getId())->query();

		if ($res) {
			$this->setDislikeCount($this->getDislikeCount()+1);
		}

		return $res;
	}

	public function delete() {
		$builder = new QueryMaster();
		$set = array('is_deleted' => 'Y');
		$res = $builder->update($set, self::$table)->where('id', $this->getId())->query();

		return $res;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$this->setLikeCount(0);
		$this->setDislikeCount(0);
		$this->setIsDeleted('N');
		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}
}
?>