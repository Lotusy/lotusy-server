<?php
class DishDao extends DishDaoGenerated {

// =========================================================================================================== public

	public static function getDishes($dishIds) {
		$dishes = array();
		foreach ($dishIds as $dishId) {
			$dish = new DishDao($dishId);
			array_push($dishes, $dish);
		}

		return $dishes;
	}

	public static function getBusinessDishes($businessId, $start, $size) {
		$dishIds = LookupDishBusinessDao::getBusinessDishes($businessId, $start, $size);

		$dishes = array();
		foreach ($dishIds as $dishId) {
			$dish = new DishDao($dishId);
			array_push($dishes, $dish);
		}

		return $dishes;
	}

	public function like($increment=true) {
		$sign = $increment ? '+' : '-';
		$builder = new QueryBuilder($this);
		$set = array('like_count' => array('quote'=>false, 'value'=>'like_count'.$sign.'1'));
		$res = $builder->update($set)->where('id', $this->getId())->query();

		if ($res) {
			$this->setLikeCount($this->getLikeCount()+1);
		}

		return $res;
	}

	public function dislike($increment=true) {
		$sign = $increment ? '+' : '-';
		$builder = new QueryBuilder($this);
		$set = array('dislike_count' => array('quote'=>false, 'value'=>'dislike_count'.$sign.'1'));
		$res = $builder->update($set)->where('id', $this->getId())->query();

		if ($res) {
			$this->setDislikeCount($this->getDislikeCount()+1);
		}

		return $res;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$lookup = new LookupDishBusinessDao();
		$lookup->setDishId($this->getId());
		$lookup->setBusinessId($this->getBusinessId());
		$lookup->save();

		$this->setLikeCount(0);
		$this->setDislikeCount(0);
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>