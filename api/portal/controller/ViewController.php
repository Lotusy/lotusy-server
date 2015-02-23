<?php
abstract class ViewController {

	protected function render($params) {
		foreach ($params as $key=>$val) {
			${$key} = $val;
		}

		if (file_exists('view/'.$view)) {
			include 'view/'.$view;
		} else {
			throw new Exception('View does not exist.');
		}
	}

	protected function redirect($url) {
		header('Location: '.$url);
		exit;
	}

	protected function response($body, $status='200 OK') {
		header('HTTP/1.0 '.$status);
		echo json_encode($body);
		exit;
	}

	public function execute() {
		$this->cookieLogin();

		if ($this->checkLogin()) {
			global $_LSESSION, $_URI;
			if (!$_LSESSION->exist(LSession::$AUTHINDEX)) {
				$this->redirect('login?redirect_uri='.$_URI);
			}
		}

		$this->control();
	}

	protected function loginRedirect($message=null) {
		global $_LSESSION;

		if ($_LSESSION->exist(LSession::$AUTHINDEX)) {
			$redirect_uri = param('redirect_uri');

			if (empty($redirect_uri)) {
				$redirect_uri = '/profile';
			}

			if (!empty($message)) {
				if (strpos($redirect_uri, '?') !== FALSE) {
					$redirect_uri.= '&msg='.$message;
				} else {
					$redirect_uri.= '?msg='.$message;
				}
			}

			$this->redirect($redirect_uri);
		}
	}

	private function cookieLogin() {
		if (isset($_COOKIE[LSession::$COOKIE_TOKEN])) {
			$cookieToken = $_COOKIE[LSession::$COOKIE_TOKEN];
			$userId = User::cookieLogin($cookieToken);

			if ($userId>0) {
				$user = new User($userId);
				if ($user->isActive()) {
					global $_LSESSION;
					$_LSESSION->set(LSession::$AUTHINDEX, $userId);
					$_LSESSION->set(LSession::$PROFILEIMG, $user->getProfilePic());
					$_LSESSION->set(LSession::$PROFILENAME, $user->getName());
					setcookie(LSession::$COOKIE_TOKEN, $cookieToken, time()+2628000 , '/', 'account.confone.com', false, true);
				}
			}
		}
	}

	protected function checkLogin() {
		return true;
	}

	abstract protected function control();
}
?>