<?php
$component_name = 'api';

$base_host = 'http://local.api.lotusy.com';
$base_uri = '/rest';

$app_key = 'E268443E43D93DAB7EBEF303BBE9642F';
$base_account_host = 'http://local.account.lotusy.com';
$base_business_host = 'http://local.business.lotusy.com';
$base_comment_host = 'http://local.comment.lotusy.com';

//=======================================================================================
// auto include directory information
$autoload_dirs = array (
'../dao',
'../util', 
'../dao/generated',

'../dao/core',
'handler/core',
'request/core',
'validator/core',

'../dao/account',
'handler/account',
'request/account', 
'validator/account', 

'../dao/business',
'handler/business',
'request/business', 
'validator/business', 

'../dao/comment',
'handler/comment', 
'request/comment', 
'validator/comment', 

'../dao/image',
'handler/image', 
'request/image', 
'validator/image', 
);


//=======================================================================================
// logging information
// INFO=4, WARN=3, ERROR=2, FATAL=1, NOTHING=0
$log_level = 4;
$log_file = '/opt/lotusy/api/logs/rest.log';

$access_on = 1;
$access_log = '/opt/lotusy/api/logs/rest_access.log';


//=======================================================================================
// database information
$DB_HOST = 'localhost';
$DB_USER = 'foodsteraccount';
$DB_PASS = 'foodsterpasswd';
$DB_NAME = 'foodster';

// 0 - OFF, 1 - ERROR, 2 - INFO
$DB_LOG_LEVEL = 2;


//=======================================================================================
// ip block list
$ip_block_list = array (
'000.000.000.000' => 1,
'127.0.0.1' => 0
);
?>