<?php
class LookupRefreshAccessDao extends LookupRefreshAccessDaoGenerated {

// ========================================================================================== public



// ======================================================================================== override

	protected function beforeInsert() {
		$refreshToken = $this->getRefreshToken();
		$sequence = Utility::hashString($refreshToken);
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>