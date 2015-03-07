<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/CommentImageContentTest.php';

$baseUri = 'http://local.image.foodster.club/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
    0 => new CommentImageContentTest()
);

$inputs = array(
    0 => array(
        'imageid' => 1
    )
);
?>