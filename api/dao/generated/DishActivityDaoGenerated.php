<?php
abstract class DishActivityDaoGenerated extends LotusyDaoParent {

    protected static $table = 'dish_activity';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['user_id'] = null;
        $this->var['dish_id'] = null;
        $this->var['business_id'] = null;
        $this->var['activity'] = null;
        $this->var['is_deleted'] = null;
        $this->var['create_time'] = null;

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['dish_id'] = false;
        $this->update['business_id'] = false;
        $this->update['activity'] = false;
        $this->update['is_deleted'] = false;
        $this->update['create_time'] = false;
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

    public function setActivity($activity) {
        if ($this->var['activity'] !== $activity) {
            $this->var['activity'] = $activity;
            $this->update['activity'] = true;
        }
    }
    public function getActivity() {
        return $this->var['activity'];
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