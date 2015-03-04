<?php
class SignatureImageDao extends ImageSignatureDaoGenerated {

	public static function getUserSignatures($userId) {
		$builder = new QueryMaster();
		$res = $builder->select('*', self::$table)
						->where('user_id', $userId)
						->findList();

		return self::makeObjectsFromSelectListResult($res, 'SignatureImageDao', true);
	}

	public static function deleteUserSignature($userId, $signatureId) {
		$builder = new QueryMaster();
		$res = $builder->delete(self::$table)
						->where('id', $signatureId)
						->where('user_id', $userId)
						->query();
		return $res;
	}

	// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}
}
?>