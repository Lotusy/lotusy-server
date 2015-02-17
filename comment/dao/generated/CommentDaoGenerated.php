<?php
abstract class CommentDaoGenerated extends LotusyDaoParent {

    protected static $table = 'comment';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['business_id'] = null;
        $this->var['user_id'] = null;
        $this->var['dish_id'] = null;
        $this->var['lat'] = null;
        $this->var['lng'] = null;
        $this->var['message'] = null;
        $this->var['like_count'] = null;
        $this->var['dislike_count'] = null;
        $this->var['is_deleted'] = null;
        $this->var['create_time'] = null;

        $this->update['id'] = false;
        $this->update['business_id'] = false;
        $this->update['user_id'] = false;
        $this->update['dish_id'] = false;
        $this->update['lat'] = false;
        $this->update['lng'] = false;
        $this->update['message'] = false;
        $this->update['like_count'] = false;
        $this->update['dislike_count'] = false;
        $this->update['is_deleted'] = false;
        $this->update['create_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setBusinessId($business_id) {
        if ($this->var['business_id'] !== $business_id) {
            $this->var['business_id'] = $business_id;
            $this->update['business_id'] = true;
        }
    }
    public function getBusinessId() {
        return $this->var['business_id'];
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

    public function setDishId($dish_id) {
        if ($this->var['dish_id'] !== $dish_id) {
            $this->var['dish_id'] = $dish_id;
            $this->update['dish_id'] = true;
        }
    }
    public function getDishId() {
        return $this->var['dish_id'];
    }

    public function setLat($lat) {
        if ($this->var['lat'] !== $lat) {
            $this->var['lat'] = $lat;
            $this->update['lat'] = true;
        }
    }
    public function getLat() {
        return $this->var['lat'];
    }

    public function setLng($lng) {
        if ($this->var['lng'] !== $lng) {
            $this->var['lng'] = $lng;
            $this->update['lng'] = true;
        }
    }
    public function getLng() {
        return $this->var['lng'];
    }

    public function setMessage($message) {
        if ($this->var['message'] !== $message) {
            $this->var['message'] = $message;
            $this->update['message'] = true;
        }
    }
    public function getMessage() {
        return $this->var['message'];
    }

    public function setLikeCount($like_count) {
        if ($this->var['like_count'] !== $like_count) {
            $this->var['like_count'] = $like_count;
            $this->update['like_count'] = true;
        }
    }
    public function getLikeCount() {
        return $this->var['like_count'];
    }

    public function setDislikeCount($dislike_count) {
        if ($this->var['dislike_count'] !== $dislike_count) {
            $this->var['dislike_count'] = $dislike_count;
            $this->update['dislike_count'] = true;
        }
    }
    public function getDislikeCount() {
        return $this->var['dislike_count'];
    }

    public function setIsDeleted($is_deleted) {
        if ($this->var['is_deleted'] !== $is_deleted) {
            $this->var['is_deleted'] = $is_deleted;
            $this->update['is_deleted'] = true;
        }
    }
    public function getIsDeleted() {
        return $this->var['is_deleted'];
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