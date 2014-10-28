<?php
abstract class AdminDaoGenerated extends LotusyDaoBase {

    protected static $table = 'admin';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['email'] = null;
        $this->var['password'] = null;
        $this->var['username'] = null;

        $this->update['id'] = false;
        $this->update['email'] = false;
        $this->update['password'] = false;
        $this->update['username'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setEmail($email) {
        if ($this->var['email'] != $email) {
            $this->var['email'] = $email;
            $this->update['email'] = true;
        }
    }
    public function getEmail() {
        return $this->var['email'];
    }

    public function setPassword($password) {
        if ($this->var['password'] != $password) {
            $this->var['password'] = $password;
            $this->update['password'] = true;
        }
    }
    public function getPassword() {
        return $this->var['password'];
    }

    public function setUsername($username) {
        if ($this->var['username'] != $username) {
            $this->var['username'] = $username;
            $this->update['username'] = true;
        }
    }
    public function getUsername() {
        return $this->var['username'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}