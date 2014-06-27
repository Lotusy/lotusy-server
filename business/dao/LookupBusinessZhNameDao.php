<?php
class LookupBusinessZhNameDao extends LookupBusinessZhNameDaoGenerated {

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->var[LookupBusinessZhNameDao::ZHNAME]);
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>