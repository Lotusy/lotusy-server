<?php
class HttpTransactionDao extends LotusyObject {

	const TYPE = 'type';
	const CODE = 'code';
	const URL = 'url';
	const METHOD = 'method';
	const REQUEST = 'request';
	const RESPONSE = 'response';
	const CREATETIME = 'create_time';
	const DURATION = 'duration';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'transaction';
	const TABLE = 'httptransaction';
	const ODBNAME = 'transaction';


//========================================================================================== public


//======================================================================================= protected

	/**
	 * (non-PHPdoc)
	 * @see PaymentDaoBase::init()
	 */
	protected function init() {
		$this->var[HttpTransactionDao::IDCOLUMN] = 0;
		$this->var[HttpTransactionDao::CODE] = '100';
		$this->var[HttpTransactionDao::TYPE] = '';
		$this->var[HttpTransactionDao::URL] = '';
		$this->var[HttpTransactionDao::METHOD] = '';
		$this->var[HttpTransactionDao::REQUEST] = '';
		$this->var[HttpTransactionDao::RESPONSE] = '';
		$this->var[HttpTransactionDao::CREATETIME] = date('Y-m-d H:i:s');
		$this->var[HttpTransactionDao::DURATION] = '';
	}

	protected function getTableName() {
		return HttpTransactionDao::TABLE;
	}

	protected function getIdColumnName() {
		return HttpTransactionDao::IDCOLUMN;
	}

	protected function actionBeforeUpdate() {
		$this->var[HttpTransactionDao::MODIFIEDTIME] = date('Y-m-d H:i:s');
	}

	public function getShardDomain() {
		return HttpTransactionDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return HttpTransactionDao::ODBNAME;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>