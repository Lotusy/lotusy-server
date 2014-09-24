<?php
class LookupBusinessUserDao extends LookupBusinessUserDaoGenerated {

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getUserId();
		$this->setShardId($sequence);
	}

	protected function beforeUpdate() {
		$sequence = $this->getUserId();
		$this->setServerAddress($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>