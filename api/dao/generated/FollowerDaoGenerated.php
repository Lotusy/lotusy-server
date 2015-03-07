<?php
abstract class FollowerDaoGenerated extends LotusyDaoParent {

    protected static $table = 'follower';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['user_id'] = null;
        $this->var['follower_id'] = null;

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['follower_id'] = false;
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

    public function setFollowerId($follower_id) {
        if ($this->var['follower_id'] !== $follower_id) {
            $this->var['follower_id'] = $follower_id;
            $this->update['follower_id'] = true;
        }
    }
    public function getFollowerId() {
        return $this->var['follower_id'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}