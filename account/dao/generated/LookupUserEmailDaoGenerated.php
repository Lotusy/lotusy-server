<?php
abstract class LookupUserEmailDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['email'] = '';
        $this->var['user_id'] = '';

        $this->update['id'] = false;
        $this->update['email'] = false;
        $this->update['user_id'] = false;
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

    public function setUserId($userId) {
        $this->var['user_id'] = $userId;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'lookup_user_email';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_acct_lookup_user';
    }
}
?>