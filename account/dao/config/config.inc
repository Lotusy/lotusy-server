<?php

// Database sharding configuration 
//
if (!isset($dbconfig)) {
	$dbconfig = array();
}

$dbconfig['l_acct_user'] =
	array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.117' => array('min'=>0, 'max'=>0)
		) 
	);

$dbconfig['l_acct_lookup_user'] =
	array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.117' => array('min'=>0, 'max'=>0)
		) 
	);

$dbconfig['l_acct_token'] =
	 array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.117' => array('min'=>0, 'max'=>0)
		) 
	);

$dbconfig['l_acct_lookup_token'] =
	array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.117' => array('min'=>0, 'max'=>0)
		) 
	);

$dbconfig['l_acct_admin'] = 
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