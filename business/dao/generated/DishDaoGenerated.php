<?php
abstract class DishDaoGenerated extends LotusyDaoParent {

    protected static $table = 'dish';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['business_id'] = null;
        $this->var['user_id'] = null;
        $this->var['name_zh'] = null;
        $this->var['name_tw'] = null;
        $this->var['name_en'] = null;
        $this->var['verified'] = null;
        $this->var['like_count'] = null;
        $this->var['dislike_count'] = null;
        $this->var['create_time'] = null;

        $this->update['id'] = false;
        $this->update['business_id'] = false;
        $this->update['user_id'] = false;
        $this->update['name_zh'] = false;
        $this->update['name_tw'] = false;
        $this->update['name_en'] = false;
        $this->update['verified'] = false;
        $this->update['like_count'] = false;
        $this->update['dislike_count'] = false;
        $this->update['create_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setBusinessId($business_id) {
        if ($this->var['business_id'] != $business_id) {
            $this->var['business_id'] = $business_id;
            $this->update['business_id'] = true;
        }
    }
    public function getBusinessId() {
        return $this->var['business_id'];
    }

    public function setUserId($user_id) {
        if ($this->var['user_id'] != $user_id) {
            $this->var['user_id'] = $user_id;
            $this->update['user_id'] = true;
        }
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setNameZh($name_zh) {
        if ($this->var['name_zh'] != $name_zh) {
            $this->var['name_zh'] = $name_zh;
            $this->update['name_zh'] = true;
        }
    }
    public function getNameZh() {
        return $this->var['name_zh'];
    }

    public function setNameTw($name_tw) {
        if ($this->var['name_tw'] != $name_tw) {
            $this->var['name_tw'] = $name_tw;
            $this->update['name_tw'] = true;
        }
    }
    public function getNameTw() {
        return $this->var['name_tw'];
    }

    public function setNameEn($name_en) {
        if ($this->var['name_en'] != $name_en) {
            $this->var['name_en'] = $name_en;
            $this->update['name_en'] = true;
        }
    }
    public function getNameEn() {
        return $this->var['name_en'];
    }

    public function setVerified($verified) {
        if ($this->var['verified'] != $verified) {
            $this->var['verified'] = $verified;
            $this->update['verified'] = true;
        }
    }
    public function getVerified() {
        return $this->var['verified'];
    }

    public function setLikeCount($like_count) {
        if ($this->var['like_count'] != $like_count) {
            $this->var['like_count'] = $like_count;
            $this->update['like_count'] = true;
        }
    }
    public function getLikeCount() {
        return $this->var['like_count'];
    }

    public function setDislikeCount($dislike_count) {
        if ($this->var['dislike_count'] != $dislike_count) {
            $this->var['dislike_count'] = $dislike_count;
            $this->update['dislike_count'] = true;
        }
    }
    public function getDislikeCount() {
        return $this->var['dislike_count'];
    }

    public function setCreateTime($create_time) {
        if ($this->var['create_time'] != $create_time) {
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