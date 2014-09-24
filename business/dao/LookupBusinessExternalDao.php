<?php
class LookupBusinessExternalDao extends LookupBusinessExternalDaoGenerated {

// =========================================================================================================== public

	public static function isExternalIdExist($externalId, $externalType) {
		$lookup = new LookupBusinessExternalDao();
		$lookup->setServerAddress($externalId);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('external_type')->where('external_id', $externalId)->findList();

		foreach ($rows as $row) {
			if ($row['external_type']==$externalType) {
				return true;
			}
		}

		return false;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getExternalId();
		$this->setShardId($sequence);
	}

	protected function beforeUpdate() {
		$sequence = $this->getExternalId();
		$this->setServerAddress($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>