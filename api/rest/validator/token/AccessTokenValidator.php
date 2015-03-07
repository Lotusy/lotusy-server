<?php
abstract class AccessTokenValidator extends Validator {

    private $userId = null;

    protected function isAccessTokenValid() {
        $headers = apache_request_headers();

        $valid = isset($headers['Authorization']);
        if (!$valid) { 
            header('HTTP/1.0 400 Bad Request');
            $this->setErrorMessage('missing_access_token');
        }

        if ($valid) {
            $accessToken = explode(' ', $headers['Authorization']);

            $valid = $accessToken[0] == 'Bearer';
            if (!$valid) { 
                header('HTTP/1.0 400 Bad Request');
                $this->setErrorMessage('invalid_token_type');
            }
        }

        $accessTokenDao = AccessTokenDao::retriveDaoByAccessToken($accessToken[1]);

        if ($valid) {
            $valid = isset($accessTokenDao) && $accessTokenDao->isFromDatabase();
            if (!$valid) { 
                header('HTTP/1.0 400 Bad Request');
                $this->setErrorMessage('invalid_access_token');
            }
        }

        if ($valid) {
            $valid = !$accessTokenDao->expired();
            if (!$valid) { 
                header('HTTP/1.0 400 Bad Request');
                $this->setErrorMessage('access_token_expired');
            }
        }

        if ($valid) {
            $this->userId = $accessTokenDao->getUserId();
        }

        return $valid;
    }

    public function getUserId() {
        return $this->userId;
    }
}
?>