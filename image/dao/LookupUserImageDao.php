<?php
class LookupUserImageDao extends LookupUserImageDaoGenerated {

//========================================================================================== public

	public static function getLookupDaosByUserId($userId, $start, $size) {
		$user = new LookupUserImageDao();
		$user->setServerAddress($userId);

		$builder = new QueryBuilder($user);
		$rows = $builder->select('*')
						->where('user_id', $userId)
						->limit($start, $size)
						->findList();

		return $user->makeObjectsFromSelectListResult($rows, 'LookupUserImageDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getUserId();
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>