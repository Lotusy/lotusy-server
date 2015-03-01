<?php
abstract class ImageFastDaoGenerated extends LotusyDaoParent {

    protected static $table = 'image_fast';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['comment_id'] = null;
        $this->var['user_id'] = null;
        $this->var['dish_id'] = null;
        $this->var['business_id'] = null;
        $this->var['name'] = null;
        $this->var['path'] = null;
        $this->var['create_time'] = null;

        $this->update['id'] = false;
        $this->update['comment_id'] = false;
        $this->update['user_id'] = false;
        $this->update['dish_id'] = false;
        $this->update['business_id'] = false;
        $this->update['name'] = false;
        $this->update['path'] = false;
        $this->update['create_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setCommentId($comment_id) {
        if ($this->var['comment_id'] !== $comment_id) {
            $this->var['comment_id'] = $comment_id;
            $this->update['comment_id'] = true;
        }
    }
    public function getCommentId() {
        return $this->var['comment_id'];
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

    public function setBusinessId($business_id) {
        if ($this->var['business_id'] !== $business_id) {
            $this->var['business_id'] = $business_id;
            $this->update['business_id'] = true;
        }
    }
    public function getBusinessId() {
        return $this->var['business_id'];
    }

    public function setName($name) {
        if ($this->var['name'] !== $name) {
            $this->var['name'] = $name;
            $this->update['name'] = true;
        }
    }
    public function getName() {
        return $this->var['name'];
    }

    public function setPath($path) {
        if ($this->var['path'] !== $path) {
            $this->var['path'] = $path;
            $this->update['path'] = true;
        }
    }
    public function getPath() {
        return $this->var['path'];
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