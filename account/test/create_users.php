<?php

$size = 200;

$uri = 'http://staging.account.lotusy.com/rest/register/';
$header = array(
	'Content-Type: application/json',
	'app-key: E268443E43D93DAB7EBEF303BBE9642F'
);

for ($ii=1; $ii<=100; $ii++) {
	$type = 'facebook';
	if (rand(0,1)==1) {
		$type = 'wechat';
	}

	$body = array();
	$body['id'] = rand(100, 1000000000000);
	$body['username'] = "John ".$body['id'];
	$body['nickname'] = $body['username'];
	$body['description'] = '';
	$body['profile_pic'] = 'http://staging.account.lotusy.com/portal/img/default_profile.png';

	$response = sendRequest($uri.$type, 'POST', $header, $body);

	$additional = '';
	if ($response['status']=='error') {
		$additional = $response['description'];
	}
	echo $ii.' - '.$response['status'].' '.$additional.PHP_EOL;
}

function sendRequest($uri, $method, $header, $body=NULL) {
	$curl = curl_init($uri);

	if (isset($method)) {
		if ($method=='POST') {
			curl_setopt($curl, CURLOPT_POST, 1);
		}
		elseif ($method=='PUT') {
			curl_setopt($curl, CURLOPT_PUT, 1);
		}
		elseif ($method=='DELETE') {
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
		}
	}

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);

	if (isset($body)) {
		curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($body));
	}

	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

	$response = curl_exec($curl);

	$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	curl_close($curl);

	$response = json_decode($response, TRUE);

	$response['status_code'] = $code;

	if (!isset($response['status'])) { $response['status'] = 'error'; }

	return $response;
}
?>