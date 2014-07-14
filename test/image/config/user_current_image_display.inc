<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/UserCurrentImageContentTest.php';

$baseUri = 'http://local.image.lotusy.com/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
	0 => new UserCurrentImageContentTest()
);

$inputs = array(
	0 => array(
		'userid' => 1
	)
);
?>