<?php
abstract class LookupUserNicknameDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['nickname'] = '';
        $this->var['user_id'] = '';

        $this->update['id'] = false;
        $this->update['nickname'] = false;
        $this->update['user_id'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setNickname($nickname) {
        $this->var['nickname'] = $nickname;
        $this->update['nickname'] = true;
    }
    public function getNickname() {
        return $this->var['nickname'];
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
        return 'lookup_user_nickname';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_acct_lookup_user';
    }
}
?>