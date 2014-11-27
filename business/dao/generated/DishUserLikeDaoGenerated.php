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
        $this->update['dish_id'] = false;
        $this->update['is_like'] = false;
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

    public function setIsLike($is_like) {
        if ($this->var['is_like'] !== $is_like) {
            $this->var['is_like'] = $is_like;
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