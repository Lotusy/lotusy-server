<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/CreateCommentTest.php';

$baseUri = 'http://local.comment.foodster.club/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
    0 => new CreateCommentTest()
);

$inputs = array(
    0 => array(
        'access_token' => 'AF66F04AD2292308DBE8DD91FEDBFE53.A2F82F928D',
        'lat' => 49.249232,
        'lng' => -123.101069,
        'business_id' => 1,
        'message' => 'Testing Message # '.rand(1000, 9999)
    )
);
?>