<?php
class LookupBusinessUserDao extends LookupBusinessUserDaoGenerated {

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->var[LookupBusinessUserDao::USERID];
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>