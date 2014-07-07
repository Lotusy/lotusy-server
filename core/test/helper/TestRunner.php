<?php
class TestRunner {

	public static function run($include) {
		include $include;

		$currentResult = '';

		foreach ($testCases as $key=>$case) {
			$input = $inputs[$key];
			if ($input=='aggregate') {
				$input = $currentResult;
			}

			$currentResult = $case->execute($input);

			if ($case->validate($currentResult)) {
				echo 'Test case - '.get_class($case).' passed.'.PHP_EOL;
			} else {
				$case->failedAction();
			}
		}
	}
}
?>