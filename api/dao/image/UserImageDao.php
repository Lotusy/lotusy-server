<?php
class UserImageDao extends ImageUserDaoGenerated {

	const TYPE_COMMENT = 1;
	const TYPE_TROPHY = 2;
	const TYPE_CHALLENGE = 3;
	const TYPE_LEARNING = 4;

//========================================================================================== public

	public static function getImageDaoByUserId($userId) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
					   ->where('user_id', $userId)
					   ->where('is_deleted', 'N')
					   ->find();

		return self::makeObjectFromSelectResult($res, 'UserImageDao');
	}

	public static function getImageDaoByUserIdAndImageId($userId, $imageId) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
					   ->where('user_id', $userId)
					   ->where('id', $imageId)
					   ->find();

		return self::makeObjectFromSelectResult($res, 'UserImageDao');
	}

	public static function getImageDaoIdsByUserId($userId) {
		$builder = new QueryMaster();
		$res = $builder->select('id', self::$table)
						->where('user_id', $userId)
						->findList();

		$ids = array();
		foreach ($res as $row) {
			array_push($ids, $row['id']);
		}

		return $ids;
	}

	public static function deleteUserImages($userId) {
		$builder = new QueryMaster();
		$res = $builder->update(array('is_deleted'=>'Y'), self::$table)
					   ->where('user_id', $userId)
					   ->where('is_deleted', 'N')
					   ->query();
		return $res;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
		$this->setIsDeleted('N');
	}
}
?>