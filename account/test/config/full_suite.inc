<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/RegisterAccount.php';
include_once 'case/LoginAccount.php';

$baseUri = 'http://local.account.lotusy.com/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
	0 => new RegisterAccount(),
	1 => new LoginAccount()
);

$externalRef = time().rand(10, 99);

$inputs = array(
	0 => array(
		'type' => 'wechat',
		'user' => array(
			'id' => $externalRef,
			'username' => 'John Bob',
			'nickname' => 'jbob',
			'profile_pic' => 'http://www.facebook.com/graph/someone/profile_img.jpg',
			'description' => 'Unit Test Account'
		)
	),
	1 => array(
		'type' => 'wechat',
		'user_id' => $externalRef
	)
);
?>