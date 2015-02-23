<?php
class UserImageDao extends ImageUserDaoGenerated {

	const TYPE_COMMENT = 1;
	const TYPE_TROPHY = 2;
	const TYPE_CHALLENGE = 3;
	const TYPE_LEARNING = 4;

//========================================================================================== public

	public static function getImageDaoByUserId($userId) {
		$user = new UserImageDao();
		$user->setServerAddress($userId);

		$builder = new QueryBuilder($user);
		$res = $builder->select('*')
					   ->where('user_id', $userId)
					   ->where('is_deleted', 'N')
					   ->find();

		return self::makeObjectFromSelectResult($res, 'UserImageDao');
	}

	public static function getImageDaoByUserIdAndImageId($userId, $imageId) {
		$user = new UserImageDao();
		$user->setServerAddress($userId);

		$builder = new QueryBuilder($user);
		$res = $builder->select('*')
					   ->where('user_id', $userId)
					   ->where('id', $imageId)
					   ->find();

		return self::makeObjectFromSelectResult($res, 'UserImageDao');
	}

	public static function getImageDaoIdsByUserId($userId) {
		$user = new UserImageDao();
		$user->setServerAddress($userId);

		$builder = new QueryBuilder($user);
		$res = $builder->select('id')
						->where('user_id', $userId)
						->findList();

		$ids = array();
		foreach ($res as $row) {
			array_push($ids, $row['id']);
		}

		return $ids;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getUserId();
		$this->setShardId($sequence);

		$builder = new QueryBuilder($this);
		$set = array('is_deleted' => array('quote'=>true, 'value'=>'Y'));
		$builder->update($set)
				->where('user_id', $this->getUserId())
				->where('is_deleted', 'N')
				->query();

		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function beforeUpdate() {}

	protected function isShardBaseObject() {
		return false;
	}
}
?>