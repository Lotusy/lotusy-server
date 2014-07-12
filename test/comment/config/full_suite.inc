<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/CreateCommentTest.php';
include_once 'case/CommentInfoTest.php';
include_once 'case/LikeCommentTest.php';
include_once 'case/DislikeCommentTest.php';
include_once 'case/CreateReplyTest.php';
include_once 'case/CommentReplyTest.php';
include_once 'case/LocationCommentTest.php';
include_once 'case/UserCommentTest.php';
include_once 'case/BusinessCommentTest.php';
include_once 'case/DeleteCommentTest.php';

$baseUri = 'http://local.comment.lotusy.com/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

global $comment_id;

$testCases = array(
	0 => new CreateCommentTest(),
	1 => new CommentInfoTest(),
	2 => new LikeCommentTest(),
	3 => new LikeCommentTest(),
	4 => new DislikeCommentTest(),
	5 => new CreateReplyTest(),
	6 => new CreateReplyTest(),
	7 => new CommentReplyTest(),
	8 => new LocationCommentTest(),
	9 => new UserCommentTest(),
	10 => new BusinessCommentTest(),
	11 => new DeleteCommentTest()
);

$accessToken = 'AF66F04AD2292308DBE8DD91FEDBFE53.A2F82F928D';

$inputs = array(
	0 => array(
		'access_token' => $accessToken,
		'lat' => 49.249232,
		'lng' => -123.101069,
		'business_id' => 1,
		'message' => 'Testing Message # '.rand(1000, 9999)
	),
	1 => 'aggregate',
	2 => 'aggregate',
	3 => 'aggregate',
	4 => 'aggregate',
	5 => array(
		'access_token' => $accessToken,
		'message' => 'Testing Reply # '.rand(1000, 9999),
		'nickname' => 'john.bob'
	),
	6 => array(
		'access_token' => $accessToken,
		'message' => 'Testing Reply # '.rand(1000, 9999),
		'nickname' => 'john.bob'
	),
	7 => 'aggregate',
	8 => array(
		'access_token' => $accessToken,
		'lat' => 49.249232,
		'lng' => -123.101069
	),
	9 => array(
		'access_token' => $accessToken,
		'userid' => 1
	),
	10 => array(
		'access_token' => $accessToken,
		'businessid' => 1
	),
	11 => array(
		'access_token' => $accessToken,
	)
);
?>