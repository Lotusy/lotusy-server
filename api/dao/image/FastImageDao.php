<?php
class FastImageDao extends ImageFastDaoGenerated {

//========================================================================================== public


	public static function getLookupDaosByUserId($userId, $start, $size) {
		$user = new LookupUserImageDao();
		$user->setServerAddress($userId);
	
		$builder = new QueryBuilder($user);
		$res = $builder->select('*')
		->where('user_id', $userId)
		->limit($start, $size)
		->findList();
	
		return $user->makeObjectsFromSelectListResult($res, 'LookupUserImageDao');
	}
	
	public static function isUserImageExist($userId, $imageId) {
		$lookup = new LookupUserImageDao();
		$lookup->setServerAddress($userId);
	
		$builder = new QueryBuilder($lookup);
		$res = $builder->select('COUNT(*) as count')->where('user_id', $userId)->find();
	
		return $res['count']>0;
	}

	public static function getLookupDaosByDishId($dishId) {
		$lookup = new LookupDishImageDao();
		$lookup->setServerAddress($dishId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('*')
						->where('dish_id', $dishId)
						->findList();

		return $lookup->makeObjectsFromSelectListResult($res, 'LookupDishImageDao');
	}

	public static function isDishImageExist($dishId, $imageId) {
		$lookup = new LookupDishImageDao();
		$lookup->setServerAddress($dishId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('COUNT(*) as count')->where('dish_id', $dishId)->find();

		return $res['count']>0;
	}

	public static function getDefaultDishFastImage($dishId) {
		$lookup = new LookupDishImageDao();
		$lookup->setServerAddress($dishId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('*')
						->where('dish_id', $dishId)
						->find();

		return $lookup->makeObjectFromSelectResult($res, 'LookupDishImageDao');
	}

	public static function getLookupDaosByCommentId($commentId) {
		$comment = new LookupCommentImageDao();
		$comment->setServerAddress($commentId);
	
		$builder = new QueryBuilder($comment);
		$res = $builder->select('*')
		->where('comment_id', $commentId)
		->findList();
	
		return $comment->makeObjectsFromSelectListResult($res, 'LookupCommentImageDao');
	}
	
	public static function isCommentImageExist($commentId, $imageId) {
		$lookup = new LookupCommentImageDao();
		$lookup->setServerAddress($commentId);
	
		$builder = new QueryBuilder($lookup);
		$res = $builder->select('COUNT(*) as count')->where('comment_id', $commentId)->find();
	
		return $res['count']>0;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function beforeUpdate() {}

	protected function isShardBaseObject() {
		return true;
	}
}
?>