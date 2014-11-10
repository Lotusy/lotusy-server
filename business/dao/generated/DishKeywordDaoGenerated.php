<?php
abstract class DishKeywordDaoGenerated extends LotusyDaoParent {

    protected static $table = 'dish_keyword';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['keyword_code'] = null;
        $this->var['dish_id'] = null;

        $this->update['id'] = false;
        $this->update['keyword_code'] = false;
        $this->update['dish_id'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setKeywordCode($keyword_code) {
        if ($this->var['keyword_code'] != $keyword_code) {
            $this->var['keyword_code'] = $keyword_code;
            $this->update['keyword_code'] = true;
        }
    }
    public function getKeywordCode() {
        return $this->var['keyword_code'];
    }

    public function setDishId($dish_id) {
        if ($this->var['dish_id'] != $dish_id) {
            $this->var['dish_id'] = $dish_id;
            $this->update['dish_id'] = true;
        }
    }
    public function getDishId() {
        return $this->var['dish_id'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}