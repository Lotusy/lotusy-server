<?php
abstract class FollowerDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['user_id'] = '';
        $this->var['follower_id'] = '';

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['follower_id'] = false;
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

    public function setFollowerId($followerId) {
        $this->var['follower_id'] = $followerId;
        $this->update['follower_id'] = true;
    }
    public function getFollowerId() {
        return $this->var['follower_id'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'follower';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_acct_user';
    }
}
?>