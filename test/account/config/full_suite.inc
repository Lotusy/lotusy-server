<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/RegisterAccountTest.php';
include_once 'case/LoginAccountTest.php';
include_once 'case/GetAccessTokenInfoTest.php';
include_once 'case/GetCurrentUserProfileTest.php';
include_once 'case/GetUserProfileTest.php';

$baseUri = 'http://local.account.lotusy.com/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
	0 => new RegisterAccountTest(),
	1 => new LoginAccountTest(),
	2 => new GetAccessTokenInfoTest(),
	3 => new GetCurrentUserProfileTest(),
	4 => new GetUserProfileTest(),
);

$inputs = array(
	0 => array(
		'type' => 'facebook',
		'external_ref' => time().rand(10, 99),
		'username' => 'John Bob',
		'nickname' => 'jbob',
		'profile_pic' => 'http://www.facebook.com/graph/someone/profile_img.jpg',
		'description' => 'Unit Test Account'
	),
	1 => 'aggregate',
	2 => 'aggregate',
	3 => 'aggregate',
	4 => 'aggregate'
);
?>