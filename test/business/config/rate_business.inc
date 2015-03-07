<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/RateBusinessTest.php';

$baseUri = 'http://local.business.foodster.club/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
    0 => new RateBusinessTest()
);

$inputs = array(
    0 => array(
        'access_token' => 'AF66F04AD2292308DBE8DD91FEDBFE53.A2F82F928D',
        'id' => 1,
        "overall" => floor(rand(1,5)),
        "food" => floor(rand(1,5)),
        "serv" => floor(rand(1,5)),
        "env" => floor(rand(1,5)),
    )
);
?>