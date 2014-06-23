<?php

// Database sharding configuration 
//
if (!isset($dbconfig)) {
	$dbconfig = array();
}

$dbconfig['user'] =
	array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.117' => array('min'=>0, 'max'=>0)
		) 
	);

$dbconfig['lookup_account'] =
	array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.117' => array('min'=>0, 'max'=>0)
		) 
	);

$dbconfig['token'] =
	 array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.117' => array('min'=>0, 'max'=>0)
		) 
	);

$dbconfig['lookup_token'] =
	array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.117' => array('min'=>0, 'max'=>0)
		) 
	);

$dbconfig['account_admin'] = 
	array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.117' => array('min'=>0, 'max'=>0)
		) 
	);
?>