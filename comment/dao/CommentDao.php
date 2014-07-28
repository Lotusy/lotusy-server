<?php
class CommentDao extends CommentDaoGenerated {

//========================================================================================== public

	public static function getCommentsByLocation($lat, $lng, $radius, $start, $size, $isMiles=false) {
		$commentIds = LookupCommentLocationDao::getCommentIdsByLocation ( 
														$lat, $lng, $radius, $start, $size, $isMiles );
		$comments = array();
		foreach ($commentIds as $commentId => $distance) {
			$comment = new CommentDao($commentId);
			$comments[$distance] = $comment;
		}

		return $comments;
	}

	public static function getCommentsByBusinessId($businessId, $start, $size) {
		$commentIds = LookupCommentBusinessDao::getCommentIdsByBusinessId ( 
																$businessId, $start, $size );
		$comments = array();
		foreach ($commentIds as $commentId) {
			$comment = new CommentDao($commentId);
			array_push($comments, $comment);
		}

		return $comments;
	}

	public static function getCommentsByUserId($userId, $start, $size) {
		$commentIds = LookupCommentUserDao::getCommentIdsByUserId($userId, $start, $size);

		$comments = array();
		foreach ($commentIds as $commentId) {
			$comment = new CommentDao($commentId);
			array_push($comments, $comment);
		}

		return $comments;
	}

	public function like() {
		$builder = new QueryBuilder($this);
		$set = array('like_count' => array('quote'=>false, 'value'=>'like_count+1'));
		$res = $builder->update($set)->where('id', $this->getId())->query();

		if ($res) {
			$this->setLikeCount($this->getLikeCount()+1);
		}

		return $res;
	}

	public function dislike() {
		$builder = new QueryBuilder($this);
		$set = array('dislike_count' => array('quote'=>false, 'value'=>'dislike_count+1'));
		$res = $builder->update($set)->where('id', $this->getId())->query();

		if ($res) {
			$this->setDislikeCount($this->getDislikeCount()+1);
		}

		return $res;
	}

	public function delete() {
		$builder = new QueryBuilder($this);
		$set = array('is_deleted' => array('quote'=>true, 'value'=>'Y'));
		$res = $builder->update($set)->where('id', $this->getId())->query();

		return $res;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$lookup = new LookupCommentLocationDao();
		$lookup->setLat($this->getLat());
		$lookup->setLng($this->getLng());
		$lookup->setCommentId($this->getId());
		$lookup->save();

		$lookup = new LookupCommentUserDao();
		$lookup->setUserId($this->getUserId());
		$lookup->setCommentId($this->getId());
		$lookup->save();

		$lookup = new LookupCommentBusinessDao();
		$lookup->setBusinessId($this->getBusinessId());
		$lookup->setCommentId($this->getId());
		$lookup->save();

		$this->setLikeCount(0);
		$this->setDislikeCount(0);
		$this->setIsDeleted('N');
		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>