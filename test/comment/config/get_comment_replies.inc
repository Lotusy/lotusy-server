<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/CommentReplyTest.php';

$baseUri = 'http://local.comment.lotusy.com/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
	0 => new CommentReplyTest()
);

$inputs = array(
	0 => array(
		'access_token' => 'AF66F04AD2292308DBE8DD91FEDBFE53.A2F82F928D',
		'comment_id' => 1
	)
);
?>