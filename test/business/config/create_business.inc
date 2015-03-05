<?php
include_once '../../core/test/case/TestCase.php';
include_once '../../core/test/helper/TestRequestor.php';
include_once '../../core/test/helper/TestRunner.php';

include_once 'case/CreateBusinessTest.php';

$baseUri = 'http://local.business.foodster.club/rest';
$applicationKey = 'E268443E43D93DAB7EBEF303BBE9642F';

$testCases = array(
	0 => new CreateBusinessTest()
);

$inputs = array(
	0 => array(
		'access_token' => 'AF66F04AD2292308DBE8DD91FEDBFE53.A2F82F928D',
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
	)
);
?>