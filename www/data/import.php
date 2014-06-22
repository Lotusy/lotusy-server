<?php
include '../config/config.inc';

$fp = fopen('data00.csv', 'r');
$count = 1;
$once = false;
while ( ($line = fgets($fp)) !== false) {
	$elements = explode('|', $line);

	$request = new GoogleGeocodingRequest($elements[3], $elements[4], $elements[5]);
	$response = $request->execute();
	$once = true;

	if($response['status']!='success') {
		echo $count.' - '.$elements[0].' (FAILURE)'.PHP_EOL;
	}
	else {
		try {
			$businessSDK = new BusinessSDK('07F37F608936DDFAB4ABEA1F8037AC3F.CBDD775798');

			$business = array();
			$business['lat'] = $response['lat'];
			$business['lng'] = $response['lng'];
			$business['name_zh'] = $elements[0];
			$business['name_tw'] = $elements[1];
			$business['name_en'] = $elements[2];
			$business['street'] = $elements[3];
			$business['city'] = $elements[4];
			$business['state'] = $elements[5];
			$business['country'] = 'CA';
			$business['zip'] = $elements[6];
			$business['price'] = $elements[7];
			$business['cash_only'] = ($elements[8]=='true') ? 'Y' : 'N';
			$business['tel'] = $elements[9];
			$business['hours'] = $elements[10];
			$business['website'] = $elements[11];
			$business['social'] = $elements[12];

			$businessSDK->createBusiness($business);

			echo $count.' - '.$elements[0].' (OK)'.PHP_EOL;
		}
		catch(Exception $e) {
			echo $count.' - '.$elements[0].' (FAILURE)'.PHP_EOL;
		}
	}

	$count++;
}
?>