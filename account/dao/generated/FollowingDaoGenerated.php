<?php
abstract class FollowingDaoGenerated extends LotusyDaoParent {

    protected static $table = 'following';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['user_id'] = null;
        $this->var['following_id'] = null;

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['following_id'] = false;
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

    public function setFollowingId($following_id) {
        if ($this->var['following_id'] !== $following_id) {
            $this->var['following_id'] = $following_id;
            $this->update['following_id'] = true;
        }
    }
    public function getFollowingId() {
        return $this->var['following_id'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}