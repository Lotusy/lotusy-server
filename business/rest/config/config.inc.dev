<?php
include '../dao/config/config.inc';
include '../../core/dao/config/config.inc';

$component_name = 'business';

$base_host = 'https://local.business.lotusy.com';
$base_uri = '/rest';

$app_key = 'F5D7E2532CC9AD16BC2A41222D76F269';
$base_account_host = 'http://local.account.lotusy.com';
$base_image_host = 'http://local.image.lotusy.com';

//=======================================================================================
// auto include directory information
$autoload_dirs = array (
'handler', 
'request', 
'validator', 
'../util', 
'../dao',
'../dao/generated',
'../../core/dao',
'../../core/dao/generated',
'../../core/util',
'../../core/rest/handler',
'../../core/rest/request',
'../../core/rest/validator'
);


//=======================================================================================
// logging information
// INFO=4, WARN=3, ERROR=2, FATAL=1, NOTHING=0
$log_level = 4;
$log_file = '/opt/lotusy/business/logs/rest.log';

$access_on = 1;
$access_log = '/opt/lotusy/business/logs/rest_access.log';


//=======================================================================================
// ip block list
$ip_block_list = array (
'000.000.000.000' => 1,
'127.0.0.1' => 0
);
?>