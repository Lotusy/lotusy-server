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

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$lookup = new LookupDishBusinessDao();
		$lookup->setDishId($this->getId());
		$lookup->setBusinessId($this->getBusinessId());
		$lookup->save();
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>