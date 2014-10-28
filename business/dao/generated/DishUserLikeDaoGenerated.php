<?php
abstract class DishUserLikeDaoGenerated extends LotusyDaoParent {

    protected static $table = 'dish_user_like';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['user_id'] = null;
        $this->var['dish_id'] = null;
        $this->var['is_like'] = null;

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['password'] = false;
        $this->update['is_like'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setUserId($userId) {
        if ($this->var['user_id'] != $userId) {
            $this->var['user_id'] = $userId;
            $this->update['user_id'] = true;
        }
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setDishId($dishId) {
        if ($this->var['dish_id'] != $dishId) {
            $this->var['dish_id'] = $dishId;
            $this->update['dish_id'] = true;
        }
    }
    public function getDishId() {
        return $this->var['dish_id'];
    }

    public function setIsLike($isLike) {
        if ($this->var['is_like'] != $isLike) {
            $this->var['is_like'] = $isLike;
            $this->update['is_like'] = true;
        }
    }
    public function getIsLike() {
        return $this->var['is_like'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}