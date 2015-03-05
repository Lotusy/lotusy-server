<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/LoginAccountTest.php';

$baseUri = 'http://local.account.foodster.club/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
	0 => new LoginAccountTest()
);

$inputs = array(
	0 => array(
		'type' => 'facebook',
		'external_ref' => '140480004078'
	)
);
?>