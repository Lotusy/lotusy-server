<?php
abstract class AuthorizedRequestHandler implements RequestHandler {

    private $userId = null;
    private $accessToken = null;
    private $language = null;

    public function execute($params) {

        if (!$this->validateAuthenticationHeader()) {
            header('HTTP/1.0 401 Unauthorized');

            $response = array();
            $response['status'] = 'error';
            $response['description'] = 'unauthorized_request';
        } else {
            $headers = apache_request_headers();
            $this->language = $headers['language'];
            $response = $this->handle($params);
        }

        if (!empty($response)) {
            $response = json_encode($response);
        }

        return $response;
    }

    protected function getLanguage() {
        return $this->language;
    }

    protected function getUserId() {
        return $this->userId;
    }

    private function validateAuthenticationHeader() {
        $headers = apache_request_headers();
        $valid = isset($headers['Authorization']);

        if ($valid) {
            $accessToken = explode(' ', $headers['Authorization']);
            $valid = $accessToken[0] == 'Bearer';
        }

        if ($valid) {
            $this->accessToken = $accessToken[1];

            $token = AccessTokenDao::retriveDaoByAccessToken($this->accessToken);

            if (isset($token)) {
                $valid = !$token->expired();
            } else {
                $valid = false;
            }
        }

        if ($valid) {
            $this->userId = $token->getUserId();
        }

        return $valid;
    }

    protected function getAccessToken() {
        return $this->accessToken;
    }

    abstract public function handle($params);
}
?>