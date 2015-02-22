<?php
class GetWeiboTokenInfoRequest extends RestRequest {

	private $accessToken = '';

	public function GetWeiboTokenInfoRequest($token) {
		parent::__construct();
		$this->accessToken = $token;
	}

	protected function getUrl() {
		return 'https://api.weibo.com/2/account/get_uid.json?access_token='.$this->accessToken;
	}

	protected function getMethod() {
		return 'GET';
	}

	protected function parseResponse($response) {
		$json = json_decode($response, TRUE);
		$rv = array();
		if (isset($json['error'])) {
			$rv['status'] = 'error';
			return $rv;
		} else {
			$rv['id'] = $json['uid'];

			$userId = UserDao::getUniqueUserIdFromExternalRef(UserDao::$TYPEARRAYREV[2], $rv['id']);
			if ($userId>0) {
				$rv['status'] = 'success';
			} else {
				$request = new GetWeiboUserInfoRequest($this->accessToken, $rv['id']);
				$response = $request->execute();
				$rv = array_merge($rv, $response);
			}
		}

		return $rv;
	}
}
?>