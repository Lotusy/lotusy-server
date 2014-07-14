<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/UserImageContentTest.php';

$baseUri = 'http://local.image.lotusy.com/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
	0 => new UserImageContentTest()
);

$inputs = array(
	0 => array(
		'userid' => 1,
		'imageid' => 1
	)
);
?>