<?php
abstract class LookupRefreshAccessDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['refresh_token'] = '';
        $this->var['access_token'] = '';

        $this->update['id'] = false;
        $this->update['refresh_token'] = false;
        $this->update['access_token'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setRefreshToken($refreshToken) {
        $this->var['refresh_token'] = $refreshToken;
        $this->update['refresh_token'] = true;
    }
    public function getRefreshToken() {
        return $this->var['refresh_token'];
    }

    public function setAccessToken($accessToken) {
        $this->var['access_token'] = $accessToken;
        $this->update['access_token'] = true;
    }
    public function getAccessToken() {
        return $this->var['access_token'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'lookup_refresh_access';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_acct_lookup_token';
    }
}
?>