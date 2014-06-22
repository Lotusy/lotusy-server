<?php

// Database sharding configuration 
//
if (!isset($dbconfig)) {
	$dbconfig = array();
}

$dbconfig['image_user'] =
	array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.123' => array('min'=>0, 'max'=>0)
		) 
	);

$dbconfig['image_business'] =
	array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.123' => array('min'=>0, 'max'=>0)
		) 
	);

$dbconfig['image_comment'] =
	array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.123' => array('min'=>0, 'max'=>0)
		) 
	);

$dbconfig['lookup_comment_image'] =
	array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.123' => array('min'=>0, 'max'=>0)
		) 
	);

$dbconfig['image_admin'] = 
	array (
		'total_shards' => 1,
		'shards_digit' => 1,
		'username' => 'lotusyuser',
		'password' => 'password',
		'server_list' => array (
			'192.168.0.123' => array('min'=>0, 'max'=>0)
		) 
	);
?>