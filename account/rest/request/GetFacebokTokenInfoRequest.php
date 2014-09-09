<?php
class GetFacebookTokenInfoRequest extends RestRequest {

	private $accessToken = '';

	public function GetFacebookTokenInfoRequest($token) {
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
			$rv['id'] = $response['id'];
			$rv['username'] = $response['first_name'].' '.$response['last_name'];
			$rv['gender'] = $response['gender'];
			$rv['nickname'] = $rv['username'];
			$rv['profile_pic'] = 'https://graph.facebook.com/'.$rv['id'].'/picture?width=300&height=300';
		}

		return $rv;
	}
}
?>