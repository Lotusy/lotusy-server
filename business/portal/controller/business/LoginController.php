<?php
class LoginController extends ViewController {

	protected function control() {
		$this->loginRedirect();

		include '../util/recaptchalib.php';
		global $_LSESSION, $recaptcha_private_key;

		$loginCount = $this->initLoginCount();

		$username = param('username');
		$password = param('password');
		if (!empty($username)) {
		    if ($loginCount>=3) {
		    	$resp = recaptcha_check_answer( $recaptcha_private_key, 
						    					Utility::getClientIp(), 
						    					param('recaptcha_challenge_field'), 
						    					param('recaptcha_response_field') );
		    	if (!$resp->is_valid) {
            		$error = 'Invalid ReCAPTCHA, please try again.';
        		} else {
		    		$error = $this->login($username, $password, $loginCount);
		        }
		    } else {
		    	$error = $this->login($username, $password, $loginCount);
		    }
		} else if (isset($username)) {
			$error = 'Please enter both Email and Password';
		}

		$redirect_uri = param('redirect_uri');

		$this->render( array(
			'view' => 'account/login.php',
			'title' => 'Login | Confone',
			'recaptcha' => $loginCount>=2,
			'email' => $username,
			'redirect_uri' => empty($redirect_uri) ? '/profile' : $redirect_uri,
			'message' => param('msg'),
			'error' => isset($error) ? $error : null
		));
	}

	private function initLoginCount() {
		global $_LSESSION;

		if (!$_LSESSION->exist('login_count')) {
		    $_LSESSION->set('login_count', 0);
		    $loginCount = 0;
		} else {
			$loginCount = $_LSESSION->get('login_count');
		}

		return $loginCount;
	}

	private function login($username, $password, $loginCount) {
		global $_LSESSION;

        $user = User::authenticate($username, $password);

        if (isset($user)) {
	        if (!$user->isActive()) {
	            $_LSESSION->set(ASession::$ACTIVATION, $user->getId());
				$activationToken = $user->generateAccountActivationToken();
				EmailUtil::sendActivationEmail($user->getEmail(), $user->getName(), $user->getId(), $activationToken);
	            $this->redirect('/pending');
	        }

         	$userId = $user->getId();
            $_LSESSION->set('login_count', 0);
            $_LSESSION->set(ASession::$AUTHINDEX, $userId);
			$_LSESSION->set(ASession::$PROFILEIMG, $user->getProfilePic());
			$_LSESSION->set(ASession::$PROFILENAME, $user->getName());
            if (param('keep_login')) {
            	$token = $user->generateRememberMeToken();
            	if (isset($token)) {
            		setcookie(ASession::$COOKIE_TOKEN, $token, time()+2628000 , '/', 'account.confone.com', false, true);
            	}
            }
            $this->redirect(param('redirect_uri'));
        } else {
            $_LSESSION->set('login_count', $loginCount+1);
            Logger::warn('Login attemp: '.$username.':'.$password.' failed!');
            return 'Invalid Email/Password combination.';
        }
	}

	protected function checkLogin() {
		return false;
	}
}
?>