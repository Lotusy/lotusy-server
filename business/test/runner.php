<?php
$testCaseConfig = $argv[1];

include $testCaseConfig;

echo 'Running test case configuration - '.$testCaseConfig.PHP_EOL;

TestRunner::run($testCaseConfig);
?>