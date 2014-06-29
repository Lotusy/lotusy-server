<?php
class LookupBusinessEnNameDao extends LookupBusinessEnNameDaoGenerated {

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->getEnName());
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>