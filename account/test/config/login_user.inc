<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/LoginAccount.php';

$baseUri = 'http://local.account.lotusy.com/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
	0 => new LoginAccount()
);

$inputs = array(
	0 => array(
		'type' => 'wechat',
		'user_id' => '140480004078'
	)
);
?>