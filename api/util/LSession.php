<?php
class LSession {

    public static $AUTHINDEX = 'auth_index';
    public static $PROFILEIMG = 'auth_profile_img';
    public static $PROFILENAME = 'auth_profile_name';
    public static $ACTIVATION = '_activation';
    public static $RESETPASSWD = '_resetpasswd';
    public static $SESSION_KEY = 'LOTUSYSESSIONID';
    public static $COOKIE_TOKEN = 'LOTUSYCTOKEN';

    private $sessionId = null;
    private $sessionCache = null;

    private static $LSession = null;


    public static function instance() {
        if (!isset(self::$LSession)) {
            self::$LSession = new LSession();
        }

        return self::$LSession;
    }

    private function __construct() {
        $this->sessionCache = CacheUtil::getInstance();

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

            setcookie(self::$SESSION_KEY, $this->sessionId, 0, '/', 'foodster.club', false, true);
        }
    }

    public function set($key, $value) {
        $session = $this->sessionCache->get($this->sessionId);
        if (!$session) {
            $session = array();
        }
        $session[$key] = $value;
        global $session_expires_in;
        $this->sessionCache->set($this->sessionId, $session, $session_expires_in);
    }

    public function get($key) {
        global $session_expires_in;
        $session = $this->sessionCache->get($this->sessionId);
        $this->sessionCache->set($this->sessionId, $session, $session_expires_in);
        if (isset($session[$key])) {
            return $session[$key];
        } else {
            return null;
        }
    }

    public function exist($key) {
        global $session_expires_in;
        $session = $this->sessionCache->get($this->sessionId);
        $this->sessionCache->set($this->sessionId, $session, $session_expires_in);
        return isset($session[$key]);
    }

    public function destroy() {
        $this->sessionCache->delete($this->sessionId);
        setcookie(self::$SESSION_KEY, $this->sessionId, time()-3600, '/', 'foodster.club', false, true);
    }

    public function hasUserId() {
        global $session_expires_in;
        $session = $this->sessionCache->get($this->sessionId);
        $this->sessionCache->set($this->sessionId, $session, $session_expires_in);
        return isset($session[self::$AUTHINDEX]);
    }

    public function getUserId() {
        global $session_expires_in;
        $session = $this->sessionCache->get($this->sessionId);
        $this->sessionCache->set($this->sessionId, $session, $session_expires_in);
        return $session[self::$AUTHINDEX];
    }
}
?>