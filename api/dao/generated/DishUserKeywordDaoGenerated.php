<?php
abstract class DishUserKeywordDaoGenerated extends LotusyDaoParent {

    protected static $table = 'dish_user_keyword';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['user_id'] = null;
        $this->var['dish_id'] = null;
        $this->var['keyword_code'] = null;

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['dish_id'] = false;
        $this->update['keyword_code'] = false;
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

    public function setKeywordCode($keyword_code) {
        if ($this->var['keyword_code'] !== $keyword_code) {
            $this->var['keyword_code'] = $keyword_code;
            $this->update['keyword_code'] = true;
        }
    }
    public function getKeywordCode() {
        return $this->var['keyword_code'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}