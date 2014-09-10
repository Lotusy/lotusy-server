<?php
class GetFacebookTokenInfoRequest extends RestRequest {

	private $accessToken = '';

	public function GetFacebookTokenInfoRequest($token) {
		parent::__construct();
		$this->accessToken = $token;
	}

	protected function getUrl() {
		return 'https://graph.facebook.com/me?access_token='.$this->accessToken;
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
			$rv['status'] = 'success';
			$rv['id'] = $json['id'];
			$rv['username'] = $json['first_name'].' '.$json['last_name'];
			$rv['gender'] = strtoupper($json['gender']);
			$rv['nickname'] = $rv['username'];
			$rv['profile_pic'] = 'https://graph.facebook.com/'.$rv['id'].'/picture?width=300&height=300';
		}

		return $rv;
	}
}
?>