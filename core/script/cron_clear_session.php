<?php
include '/opt/lotusy/core/util/CacheUtil.php';

$cache_servers = array (
'127.0.0.1' => 11211
);

$cacheUtil = new CacheUtil();
$sessionCache = $cacheUtil->getCacheObj();

foreach ($sessionCache->getAllKeys() as $key) {
	$sessionObj = $sessionCache->get($key);
	if (isset($sessionObj['LAST_ACTIVE'])) {
		if ($sessionObj['LAST_ACTIVE'] + 14400 < time()) {
			$sessionCache->delete($key);
		}
	}
}
?>