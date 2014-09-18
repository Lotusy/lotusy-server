<?php
class LookupDishImageDao extends LookupDishImageDaoGenerated {

//========================================================================================== public

	public static function getLookupDaosByDishId($dishId) {
		$lookup = new LookupDishImageDao();
		$lookup->setServerAddress($dishId);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('*')
						->where('dish_id', $dishId)
						->findList();

		return $lookup->makeObjectsFromSelectListResult($rows, 'LookupCommentImageDao');
	}

	public static function isDishImageExist($dishId, $imageId) {
		$lookup = new LookupDishImageDao();
		$lookup->setServerAddress($dishId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('COUNT(*) as count')->where('dish_id', $dishId)->find();

		return $res['count']>0;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getDishId();
		$this->setShardId($sequence);

		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>