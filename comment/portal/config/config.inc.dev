<?php
include '../dao/config/config.inc';
include '/opt/lotusy/core/dao/config/config.inc';

$component_name = 'r8et0';

$base_host = 'http://local.comment.lotusy.com';
$base_uri = '/portal';

$app_key = '06D4CD63BDE972FC66A0AED41D2F5C51';
$base_account_host = 'http://local.account.lotusy.com';

//=======================================================================================
// auto include directory information
$autoload_dirs = array (
'../util', 
'../dao',
'../../core/dao',
'../../core/util',
'../../core/rest/handler',
'../../core/rest/request',
'../../core/rest/validator'
);


//=======================================================================================
// logging information
// INFO=4, WARN=3, ERROR=2, FATAL=1, NOTHING=0
$log_level = 4;
$log_file = '/opt/lotusy/comment/logs/portal.log';

$access_on = 1;
$access_log = '/opt/lotusy/comment/logs/portal_access.log';


//=======================================================================================
// ip block list
$ip_block_list = array (
'000.000.000.000' => 1,
'127.0.0.1' => 0
);


//=======================================================================================
// function to load classes
function __autoload($class_name) {
	global $autoload_dirs;

	// loop through all configured included folders for the {$class_name}.php file.
	//
	foreach ($autoload_dirs as $dir) {
		if (is_file($dir.'/'.$class_name.'.php')) {
			include ($dir.'/'.$class_name.'.php');
			return;
		}
	}
}
?>