<?php
abstract class AccessTokenDaoGenerated extends LotusyDaoParent {

    protected static $table = 'access_token';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['user_id'] = null;
        $this->var['access_token'] = null;
        $this->var['refresh_token'] = null;
        $this->var['expires_time'] = null;

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['access_token'] = false;
        $this->update['refresh_token'] = false;
        $this->update['expires_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setUserId($user_id) {
        if ($this->var['user_id'] !== $user_id) {
            $this->var['user_id'] = $user_id;
            $this->update['user_id'] = true;
        }
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setAccessToken($access_token) {
        if ($this->var['access_token'] !== $access_token) {
            $this->var['access_token'] = $access_token;
            $this->update['access_token'] = true;
        }
    }
    public function getAccessToken() {
        return $this->var['access_token'];
    }

    public function setRefreshToken($refresh_token) {
        if ($this->var['refresh_token'] !== $refresh_token) {
            $this->var['refresh_token'] = $refresh_token;
            $this->update['refresh_token'] = true;
        }
    }
    public function getRefreshToken() {
        return $this->var['refresh_token'];
    }

    public function setExpiresTime($expires_time) {
        if ($this->var['expires_time'] !== $expires_time) {
            $this->var['expires_time'] = $expires_time;
            $this->update['expires_time'] = true;
        }
    }
    public function getExpiresTime() {
        return $this->var['expires_time'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}