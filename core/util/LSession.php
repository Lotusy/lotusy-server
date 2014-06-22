<?php
class LSession {

	public static $SESSION_KEY = 'LOTUSYSESSIONID';
	public static $LAST_ACTIVE = 'LAST_ACTIVE';

	private $sessionId = null;
	private $sessionCache = null;

	private static $LSESSION = null;


	public static function instance() {
		if (!isset(self::$LSESSION)) {
			self::$LSESSION = new LSession();
		}

		return self::$LSESSION;
	}

	private function __construct() {
		$cacheUtil = new CacheUtil();
		$this->sessionCache = $cacheUtil->getCacheObj();

		if (isset($_COOKIE[self::$SESSION_KEY])) {
			$this->sessionId = $_COOKIE[self::$SESSION_KEY];
		} else {
			global $component_name;

			$time = md5(microtime());
			$rand = md5(rand(0, 10000));
			$this->sessionId = $component_name.substr($rand, 0, 5).substr($time, -10, 10);

			while ($this->sessionCache->get($this->sessionId)) {
				usleep(rand(100, 1000));

				$time = md5(microtime());
				$rand = md5(rand(0, 10000));
				$this->sessionId = $component_name.substr($rand, 0, 5).substr($time, -10, 10);
			}

			setcookie(self::$SESSION_KEY, $this->sessionId, 0, '/', '', false, true);
		}
	}

	public function set($key, $value) {
		$session = $this->sessionCache->get($this->sessionId);
		$session[$key] = $value;
		$session[self::$LAST_ACTIVE] = time();
		$this->sessionCache->set($this->sessionId, $session);
	}

	public function get($key) {
		$session = $this->sessionCache->get($this->sessionId);
		$session[self::$LAST_ACTIVE] = time();
		$this->sessionCache->set($this->sessionId, $session);
		return $session[$key];
	}

	public function destroy() {
		$this->sessionCache->delete($this->sessionId);
	}
}
?>