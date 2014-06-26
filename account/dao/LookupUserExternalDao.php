<?php
class LookupUserExternalDao extends LookupUserExternalDaoGenerated {

// ========================================================================================== public

	public static function getUserIdsFromExternalRef($externalType, $externalRef) {
		$lookup = new LookupUserExternalDao();
		$lookup->setServerAddress( Utility::hashString($externalType.$externalRef) );

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('user_id')
						->where('reference', $externalRef)
						->where('type', $externalType.'%')
						->findList();

		$atReturn = array();
		foreach ($rows as $row) {
			array_push($atReturn, $row['user_id']);
		}

		return $atReturn;
	}

	public function isExternalRefExist($externalType, $externalRef) {
		$this->setServerAddress( Utility::hashString($externalType.$externalRef) );

		$builder = new QueryBuilder($this);
		$rows = $builder->select('COUNT(*) as count')
						->where('reference', $externalRef)
						->where('type', $externalType.'%', 'LIKE')
						->find();

		return isset($res) && isset($res['count']) && $res['count']>0;
	}

// ======================================================================================== override

	protected function beforeInsert() {
		$type = $this->getType();
		$reference = $this->getReference();

		$hashStr = $type.$reference;

		$sequence = Utility::hashString($hashStr);
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>