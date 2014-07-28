<?php
include 'config/config.inc';

blockIp();
$services = array('GET'=>array(), 'POST'=>array(), 'PUT'=>array(), 'DELETE'=>array());
include 'config/mapping.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
validateHeaders();

// remove base uri from the request uri
//
if (!empty($base_uri)) { $uri = substr($uri, strlen($base_uri)); }

if ($access_on!=0) { Logger::access($method.' '.$uri); }

$uri = parseGetparams($uri);

header('Content-Type: application/json; charset=utf-8');
header('X-Powered-By: Lotusy Inc.');

// find the handler based on request uri from $services configured in mapping.php
//
$uris = explode('/', $uri);
foreach ($services[$method] as $key=>$val) {
	$keys = explode('/', $key);

	if (sizeof($uris)==sizeof($keys)) {
		$match = TRUE;
		$params = array();
		foreach ($uris as $ind=>$elem) {
			if ($uris[$ind]!=$keys[$ind]) {
				if (strpos($keys[$ind],':') !== false) {
					$index = substr($keys[$ind], 1);
					$params[$index] = $uris[$ind];
				} else {
					$match = FALSE;
				}
			}
		}

		if ($match) {
			$handler = $services[$method][$key];
			Logger::info(get_class($handler).' - start =============================');
			Logger::info('Request uri - "'.$_SERVER['REQUEST_URI']);
			Logger::info('Request - '.Utility::getRawRequestData());
			$response = $handler->execute($params);
			Logger::info($response);
			Logger::info(get_class($handler).' - end'.PHP_EOL);
			if (!empty($response)) { echo $response; }
			exit;
		}
	}
}

// cannot find handler for the request uri, return 501
//
header('HTTP/1.0 501 Not implemented');
echo '{"error":"request_not_supported"}';


//=================================================================================================


/**
 * Function check if the request ip is on the black list, if it is then block the request. 
 */
function blockIp() {
	global $ip_block_list;

	$ip = Utility::getClientIp();

	if (isset($ip_block_list[$ip]) && $ip_block_list[$ip]==1) {
		header('HTTP/1.0 403 Forbidden');
		echo '{"error":"403 Forbidden"}';
		exit;
	}
}


/**
 * Function registers a request handler to a method and a uri path used in config/mapping.php
 * 
 * @param string $method
 * @param string $path
 * @param AuthorizedRequestHandler $handler
 */
function register($method, $path, $handler) {
	global $services;
	$services[$method][$path] = $handler;
}


/**
 * autoload required class from registered autoload directories in config.inc
 * 
 * @param string $class_name
 */
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


/**
 * Parse out GET parameters in a given $uri and put them in $_GET variable.
 * 
 * @param string $uri - input uri
 * @return the same uri with GET parameters removed
 */
function parseGetparams($uri) {
	$gets = explode('?', $uri);
	if (sizeof($gets)>2) {
		header('HTTP/1.0 400 Bad Request');
		echo '{"error":"400 Bad Request"}';
		$uri = $_SERVER['REQUEST_URI'];
		$method = $_SERVER['REQUEST_METHOD'];
		exit;
	} elseif (sizeof($gets)==2) {
		$getParams = explode('&', $gets[1]);
		foreach ($getParams as $getParam) {
			$pair = explode('=', $getParam);
			if (sizeof($pair)==2) {
				$_GET[$pair[0]] = $pair[1];
			}
		}
	}

	return $gets[0];
}


/**
 * Function validates all neccessary headers incluidng app-key and Content-Type
 */
function validateHeaders() {
	global $_CLIENT;

	$headers = apache_request_headers();

	if (isset($headers['app-key'])) {
		$_CLIENT = new ClientDao();
		$_CLIENT = $_CLIENT->getClientByAppKey($headers['app-key']);
	} else {
		if (strpos($_SERVER['REQUEST_URI'], 'callback')!==FALSE || 
			strpos($_SERVER['REQUEST_URI'], 'display')!==FALSE) {
			return;
		}
	}

	if (!$_CLIENT) {
		header('HTTP/1.0 401 Unauthorized');
		echo '{"error":"401 Unauthorized"}';
		exit;
	}

	if (!isset($headers['Content-Type']) || $headers['Content-Type']!='application/json') {
		header('HTTP/1.0 406 Not Acceptable');
		echo '{"error":"406 Not Acceptable"}';
		exit;
	}
}
?>