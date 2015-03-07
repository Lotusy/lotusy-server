<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/CommentImageUploadTest.php';
include_once 'case/BusinessImageUploadTest.php';
include_once 'case/UserImageUploadTest.php';
include_once 'case/UserImageLinksTest.php';
include_once 'case/UserProfileImageLinksTest.php';
include_once 'case/BusinessImageLinksTest.php';
include_once 'case/CommentImageLinksTest.php';
include_once 'case/CommentImageContentTest.php';
include_once 'case/BusinessImageContentTest.php';
include_once 'case/UserImageContentTest.php';
include_once 'case/UserCurrentImageContentTest.php';

$baseUri = 'http://local.image.foodster.club/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
    0 => new CommentImageUploadTest(),
    1 => new BusinessImageUploadTest(),
    2 => new UserImageUploadTest(),
    3 => new CommentImageLinksTest(),
    4 => new BusinessImageLinksTest(),
    5 => new UserImageLinksTest(),
    6 => new UserProfileImageLinksTest(),
    7 => new CommentImageContentTest(),
    8 => new BusinessImageContentTest(),
    9 => new UserImageContentTest(),
    10 => new UserCurrentImageContentTest()
);

$accessToken = 'AF66F04AD2292308DBE8DD91FEDBFE53.A2F82F928D';

$inputs = array(
    0 => array(
        'access_token' => $accessToken,
        'commentid' => 1,
        'image' => 'image_comment.png'
    ),
    1 => array(
        'access_token' => $accessToken,
        'businessid' => 1,
        'image' => 'image_business.png'
    ),
    2 => array(
        'access_token' => $accessToken,
        'image' => 'image_user.jpg'
    ),
    3 => array(
        'access_token' => $accessToken,
        'commentid' => 1
    ),
    4 => array(
        'access_token' => $accessToken,
        'businessid' => 1
    ),
    5 => array(
        'access_token' => $accessToken,
        'userid' => 1
    ),
    6 => array(
        'access_token' => $accessToken,
        'userid' => 1
    ),
    7 => array(
        'imageid' => 1
    ),
    8 => array(
        'businessid' => 1
    ),
    9 => array(
        'userid' => 1,
        'imageid' => 1
    ),
    10 => array(
        'userid' => 1
    )
);
?>