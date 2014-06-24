<?php
abstract class AccessTokenDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['user_id'] = '';
        $this->var['access_token'] = '';
        $this->var['refresh_token'] = '';
        $this->var['expires_time'] = '';

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['access_token'] = false;
        $this->update['refresh_token'] = false;
        $this->update['expires_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setUserId($userId) {
        $this->var['user_id'] = $userId;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setAccessToken($accessToken) {
        $this->var['access_token'] = $accessToken;
        $this->update['access_token'] = true;
    }
    public function getAccessToken() {
        return $this->var['access_token'];
    }

    public function setRefreshToken($refreshToken) {
        $this->var['refresh_token'] = $refreshToken;
        $this->update['refresh_token'] = true;
    }
    public function getRefreshToken() {
        return $this->var['refresh_token'];
    }

    public function setExpiresTime($expiresTime) {
        $this->var['expires_time'] = $expiresTime;
        $this->update['expires_time'] = true;
    }
    public function getExpiresTime() {
        return $this->var['expires_time'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'access_token';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_acct_token';
    }
}
?>