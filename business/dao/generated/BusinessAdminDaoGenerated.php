<?php
abstract class BusinessAdminDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['email'] = '';
        $this->var['password'] = '';
        $this->var['username'] = '';

        $this->update['id'] = false;
        $this->update['email'] = false;
        $this->update['password'] = false;
        $this->update['username'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setEmail($email) {
        $this->var['email'] = $email;
        $this->update['email'] = true;
    }
    public function getEmail() {
        return $this->var['email'];
    }

    public function setPassword($password) {
        $this->var['password'] = $password;
        $this->update['password'] = true;
    }
    public function getPassword() {
        return $this->var['password'];
    }

    public function setUsername($username) {
        $this->var['username'] = $username;
        $this->update['username'] = true;
    }
    public function getUsername() {
        return $this->var['username'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'business_admin';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_busi_admin';
    }
}
?>