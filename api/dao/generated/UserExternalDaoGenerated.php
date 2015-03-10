<?php
abstract class UserExternalDaoGenerated extends LotusyDaoParent {

    protected static $table = 'user_external';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['type'] = null;
        $this->var['reference'] = null;
        $this->var['user_id'] = null;
        $this->var['profile_pic'] = null;
        $this->var['username'] = null;
        $this->var['create_time'] = null;

        $this->update['id'] = false;
        $this->update['type'] = false;
        $this->update['reference'] = false;
        $this->update['user_id'] = false;
        $this->update['profile_pic'] = false;
        $this->update['username'] = false;
        $this->update['create_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setType($type) {
        if ($this->var['type'] !== $type) {
            $this->var['type'] = $type;
            $this->update['type'] = true;
        }
    }
    public function getType() {
        return $this->var['type'];
    }

    public function setReference($reference) {
        if ($this->var['reference'] !== $reference) {
            $this->var['reference'] = $reference;
            $this->update['reference'] = true;
        }
    }
    public function getReference() {
        return $this->var['reference'];
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

    public function setProfilePic($profile_pic) {
        if ($this->var['profile_pic'] !== $profile_pic) {
            $this->var['profile_pic'] = $profile_pic;
            $this->update['profile_pic'] = true;
        }
    }
    public function getProfilePic() {
        return $this->var['profile_pic'];
    }

    public function setUsername($username) {
        if ($this->var['username'] !== $username) {
            $this->var['username'] = $username;
            $this->update['username'] = true;
        }
    }
    public function getUsername() {
        return $this->var['username'];
    }

    public function setCreateTime($create_time) {
        if ($this->var['create_time'] !== $create_time) {
            $this->var['create_time'] = $create_time;
            $this->update['create_time'] = true;
        }
    }
    public function getCreateTime() {
        return $this->var['create_time'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}