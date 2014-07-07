<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/RegisterAccount.php';

$baseUri = 'http://local.account.lotusy.com/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
	0 => new RegisterAccount()
);

$inputs = array(
	0 => array(
		'type' => 'wechat',
		'user' => array(
			'id' => time().rand(10, 99),
			'username' => 'John Bob',
			'nickname' => 'jbob',
			'profile_pic' => 'http://www.facebook.com/graph/someone/profile_img.jpg',
			'description' => 'Unit Test Account'
		)
	)
);
?>