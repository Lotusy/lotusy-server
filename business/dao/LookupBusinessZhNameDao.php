<?php
class LookupBusinessZhNameDao extends LookupBusinessZhNameDaoGenerated {

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->getZhName());
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>