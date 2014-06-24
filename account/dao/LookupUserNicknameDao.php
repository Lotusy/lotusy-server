<?php
class LookupUserNicknameDao extends LookupUserNicknameDaoGenerated {

// ========================================================================================== public

	public static function getUserIdsFromNickName($nickname) {
		$lookup = new LookupUserNickNameDao();
		$lookup->setServerAddress( Utility::hashString($nickname) );

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('user_id')->where('nickname', '%'.$nickname.'%', 'LIKE')->findList();

		$atReturn = array();
		foreach ($rows as $row) {
			array_push($atReturn, $row['user_id']);
		}

		return $atReturn;
	}

// ======================================================================================== override

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->getNickname());
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>