<?php
class LookupBusinessTwNameDao extends LookupBusinessTwNameDaoGenerated {

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->var[LookupBusinessTwNameDao::TWNAME]);
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>