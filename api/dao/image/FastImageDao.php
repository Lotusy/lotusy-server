<?php
class FastImageDao extends ImageFastDaoGenerated {

//========================================================================================== public


	public static function getLookupDaosByUserId($userId, $start, $size) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
		->where('user_id', $userId)
		->limit($start, $size)
		->findList();
	
		return self::makeObjectsFromSelectListResult($res, 'FastImageDao');
	}
	
	public static function isUserImageExist($userId, $imageId) {
		$builder = new QueryMaster();
		$res = $builder->select('COUNT(*) as count', self::$table)->where('user_id', $userId)->find();
	
		return $res['count']>0;
	}

	public static function getLookupDaosByDishId($dishId) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
						->where('dish_id', $dishId)
						->findList();

		return self::makeObjectsFromSelectListResult($res, 'FastImageDao');
	}

	public static function isDishImageExist($dishId, $imageId) {
		$builder = new QueryMaster();
		$res = $builder->select('COUNT(*) as count', self::$table)->where('dish_id', $dishId)->find();

		return $res['count']>0;
	}

	public static function getDefaultDishFastImage($dishId) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
						->where('dish_id', $dishId)
						->find();

		return self::makeObjectFromSelectResult($res, 'FastImageDao');
	}

	public static function getLookupDaosByCommentId($commentId) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
		->where('comment_id', $commentId)
		->findList();
	
		return self::makeObjectsFromSelectListResult($res, 'FastImageDao');
	}
	
	public static function isCommentImageExist($commentId, $imageId) {
		$builder = new QueryMaster();
		$res = $builder->select('COUNT(*) as count', self::$table)->where('comment_id', $commentId)->find();
	
		return $res['count']>0;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}
}
?>