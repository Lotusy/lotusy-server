<?php
class LookupCommentDishDao extends LookupCommentDishDaoGenerated {

//========================================================================================== public

	public static function getCommentIdsByDishId($dishId, $start, $size) {
		$lookup = new LookupCommentDishDao();
		$lookup->setServerAddress($dishId);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('comment_id')
						->where('dish_id', $dishId)
						->limit($start, $size)
						->findList();
		$ids = array();
		foreach ($rows as $row) {
			array_push($ids, $row['comment_id']);
		}

		return $ids;
	}

	public static function getCommentCountByDishId($dishId) {
		$lookup = new LookupCommentDishDao();
		$lookup->setServerAddress($dishId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('COUNT(*) as count')
					   ->where('dish_id', $dishId)
					   ->find();

		return $res['count'];
	}

	public static function getUserDishComment($dishId, $userId) {
		$lookup = new LookupCommentDishDao();
		$lookup->setServerAddress($dishId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('comment_id')
					   ->where('dish_id', $dishId)
					   ->where('user_id', $userId)
					   ->order('id', true)
					   ->find();

		return $res['comment_id'];
	}

	public static function deleteLookupDao($dishId, $commentId) {
		$lookup = new LookupCommentDishDao();
		$lookup->setServerAddress($dishId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->delete()
					   ->where('comment_id', $commentId)
					   ->query();
		return $res;
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