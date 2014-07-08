<?php
abstract class TestCase {

	private $result = null;

	abstract public function run($input);
	abstract public function validate($result);
	abstract public function failedAction();

	public function execute($input) {
		$this->result = $this->run($input);
	}

	public function getResult() {
		return $this->result;
	}

	public static function getDefaultHeader() {
		global $applicationKey;

		$header = array(
			'Content-Type: application/json',
			'app-key: '.$applicationKey
		);

		return $header;
	}
}
?>