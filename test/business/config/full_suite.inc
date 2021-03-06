<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/CreateBusinessTest.php';
include_once 'case/BusinessProfileTest.php';
include_once 'case/LocationBusinessTest.php';
include_once 'case/RateBusinessTest.php';
include_once 'case/GetBusinessRatingTest.php';
include_once 'case/CountBusinessRatingTest.php';
include_once 'case/CountUserBusinessRatingTest.php';

$baseUri = 'http://local.business.foodster.club/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
    0 => new CreateBusinessTest(),
    1 => new BusinessProfileTest(),
    2 => new LocationBusinessTest(),
    3 => new RateBusinessTest(),
    4 => new GetBusinessRatingTest(),
    5 => new CountBusinessRatingTest(),
    6 => new CountUserBusinessRatingTest()
);

$accessToken = 'AF66F04AD2292308DBE8DD91FEDBFE53.A2F82F928D';

$inputs = array(
    0 => array(
        'access_token' => $accessToken,
        'lat' => 49.249232,
        'lng' => -123.101069,
        'name_en' => 'No. 1 Beef Noodel',
        'street' => '4063 Main Street',
        'city' => 'Vancouver',
        'state' => 'BC',
        'country' => 'CA',
        'zip' => 'V5G 3H5',
        'price' => '$$$',
        'hours' => array(
            'MON' => '9am to 11pm',
            'TUE' => 'Closed',
            'WED' => '9am to 11pm'
        ),
        'cash_only' => 'Y',
        'tel' => '604-123-1234',
        'website' => 'http => //www.jynoodle.com/vancouver/1_topic/cvancouver.html',
        'social' => 'http => //www.facebook.com/no1beefnoodle'
    ),
    1 => array(
        'access_token' => $accessToken,
        'id' => 1
    ),
    2 => array(
        'access_token' => $accessToken,
        'lat' => 49.149232,
        'lng' => -123.001069
    ),
    3 => array(
        'access_token' => $accessToken,
        'id' => 1,
        "overall" => floor(rand(1,5)),
        "food" => floor(rand(1,5)),
        "serv" => floor(rand(1,5)),
        "env" => floor(rand(1,5))
    ),
    4 => array(
        'access_token' => $accessToken,
        'id' => 1
    ),
    5 => array(
        'access_token' => $accessToken,
        'id' => 1
    ),
    6 => array(
        'access_token' => $accessToken,
        'bid' => 1,
        'uid' => 1
    )
);
?>