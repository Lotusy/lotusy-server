<?php
abstract class FollowingDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['user_id'] = '';
        $this->var['following_id'] = '';

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['following_id'] = false;
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

    public function setFollowingId($followingId) {
        $this->var['following_id'] = $followingId;
        $this->update['following_id'] = true;
    }
    public function getFollowingId() {
        return $this->var['following_id'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'following';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_acct_user';
    }
}
?>