<?php
class FastImageDao extends FastImageDaoGenerated {

//========================================================================================== public

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = date('Y-m-d H:i:s');
		$this->setCreateTime($date);
	}

	protected function beforeUpdate() {}

	protected function isShardBaseObject() {
		return true;
	}
}
?>