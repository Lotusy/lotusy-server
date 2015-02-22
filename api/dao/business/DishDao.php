<?php
class DishDao extends DishDaoGenerated {

// =========================================================================================================== public

	public function like($increment=true) {
		$sign = $increment ? '+' : '-';
		$builder = new QueryMaster();
		$res = $builder->update(array('like_count' => 'like_count'.$sign.'1'), self::$table, TRUE)
					   ->where('id', $this->getId())
					   ->query();
		if ($res) {
			$this->setLikeCount($this->getLikeCount()+1);
		}

		return $res;
	}

	public function dislike($increment=true) {
		$sign = $increment ? '+' : '-';
		$builder = new QueryMaster();
		$res = $builder->update(array('dislike_count' => 'dislike_count'.$sign.'1'), self::$table, TRUE)
					   ->where('id', $this->getId())
					   ->query();
		if ($res) {
			$this->setDislikeCount($this->getDislikeCount()+1);
		}

		return $res;
	}

	public static function getBusinessDishes($businessId, $start, $size) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
						->where('business_id', $businessId)
						->limit($start, $size)
						->findList();

		return self::makeObjectsFromSelectListResult($res, 'DishDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$this->setLikeCount(0);
		$this->setDislikeCount(0);
	}
}
?>