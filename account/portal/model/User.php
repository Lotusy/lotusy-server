<?php
class User extends Model {

	private $dao = null;

	public static function useEmailExist($email) {
		$userId = LookupEmailUserDao::getUserIdByEmail($email);
		return $userId!=0;
	}

	public static function getUserByEmail($email) {
		$userId = LookupEmailUserDao::getUserIdByEmail($email);
		if ($userId!=0) {
			$user = new User($userId);
		} else {
			$user = null;
		}

		return $user;
	}

    public static function authenticate($email, $passwd) {
		$userId = LookupEmailUserDao::getUserIdByEmail($email);
		if ($userId!=0) {
			$user = new User($userId);
			$dbPass = $user->dao->getPassword();
			$inPass = Utility::saltString(md5($passwd));
			if (Utility::compareSaltedString($dbPass, $inPass, 5)) {
				$date = date('Y-m-d H:i:s');
				$user->dao->setLastLogin($date);
				$user->dao->save();
			} else {
				$user = null;
			}
		} else {
			$user = null;
		}

		return $user;
    }

    public static function register($email, $name, $password, $cpassword) {
		$userDao = new UserDao();
		$userDao->setEmail($email);
		$userDao->setName($name);
		$md5Pass = md5($password);
		$userDao->setPassword(Utility::saltString($md5Pass));
		$userDao->save();

		if ($userDao->isFromDatabase()) {
    		$user = new User($userDao);
    		return $user;
		} else {
    		return null;
    	}
    }

    public static function cookieLogin($cookieToken) {
		return LookupRememberUserDao::getUserIdByCookieToken($cookieToken);
    }

    public static function removeRememberMeToken($cookieToken) {
		LookupRememberUserDao::removeToken($cookieToken);
    }

    public function generateRememberMeToken() {
    	$token = null;
		if (isset($this->dao)) {
			$token = LookupRememberUserDao::createToken($this->dao->getId());
		}

		return $token;
    }

    public function hasAccountActivationToken($token) {
   		if (isset($this->dao)) {
    		ActivationTokenDao::tokenExist($this->dao->getId(), $token);
    	} else {
    		return false;
    	}
    }

    public function consumeAccountActivationToken($token) {
    	if (isset($this->dao)) {
    		ActivationTokenDao::consumeToken($this->dao->getId(), $token);
    	}
    }

    public function generateAccountActivationToken() {
    	$token = null;
    	if (isset($this->dao)) {
    		$activationToken = new ActivationTokenDao();
    		$activationToken->setUserId($this->dao->getId());
    		$activationToken->save();

    		$token = $activationToken->getActivationToken();
    	}

    	return $token;
    }

    public function hasResetPasswordToken($token) {
   		if (isset($this->dao)) {
    		return ResetTokenDao::tokenExist($this->dao->getId(), $token);
    	} else {
    		return false;
    	}
    }

    public function consumeResetPasswordToken($token) {
    	if (isset($this->dao)) {
    		ResetTokenDao::consumeToken($this->dao->getId(), $token);
    	}
    }

    public function generateResetPasswordToken() {
    	$token = null;
    	if (isset($this->dao)) {
    		$resetToken = new ResetTokenDao();
    		$resetToken->setUserId($this->dao->getId());
    		$resetToken->save();

    		$token = $resetToken->getResetToken();
    	}

    	return $token;
    }

    public function activate($token) {
    	$validToken = ActivationTokenDao::tokenExist($this->dao->getId(), $token);
    	if ($validToken) {
    		$this->dao->setIsActive('Y');
    		$validToken = $this->dao->save();
    		ActivationTokenDao::consumeToken($this->dao->getId(), $token);
    	}

    	return $validToken;
    }

// =============================================================================== override

	public function getId() {
		if (isset($this->dao)) {
			return $this->dao->getId();
		} else {
			return 0;
		}
	}
	protected function init() {
		$input = $this->getInput();
		if (is_numeric($input)) {
			$this->dao = new UserDao($input);
		} else {
			$this->dao = $this->getInput();
		}
	}
    public function persist() {
		if (isset($this->dao)) {
    		return $this->dao->save();
		}

		return false;
    }

// =============================================================================== accesser
    
    public function getEmail() {
        return $this->dao->getEmail();
    }
    public function setPassword($password) {
		$md5Pass = md5($password);
    	$password = Utility::saltString($md5Pass);
        $this->dao->setPassword($password);
    }
    public function isActive() {
    	if (isset($this->dao)) {
	    	$active = $this->dao->getIsActive();
	    	return $active=='Y';
    	} else {
    		return false;
    	}
    }
    public function setName($name) {
        $this->dao->setName($name);
    }
    public function getName() {
        return $this->dao->getName();
    }
    public function setProfilePic($profilePic) {
        $this->dao->setProfilePic($profilePic);
    }
    public function getProfilePic() {
    	global $profile_url;
        return $profile_url.$this->dao->getProfilePic();
    }
    public function setDescription($description) {
        $this->dao->setDescription($description);
    }
    public function getDescription() {
        return $this->dao->getDescription();
    }
    public function getLastLogin() {
        return $this->dao->getLastLogin();
    }
}
?>