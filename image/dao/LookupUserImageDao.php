<?php
class LookupUserImageDao extends LookupUserImageDaoGenerated {

	const TYPE_COMMENT = 1;
	const TYPE_TROPHY = 2;
	const TYPE_CHALLENGE = 3;
	const TYPE_LEARNING = 4;

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

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getUserId();
		$this->setShardId($sequence);

		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>