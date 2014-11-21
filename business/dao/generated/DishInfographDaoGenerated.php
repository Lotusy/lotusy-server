<?php
abstract class DishInfographDaoGenerated extends LotusyDaoParent {

    protected static $table = 'dish_infograph';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['dish_id'] = null;
        $this->var['user_id'] = null;
        $this->var['item_value'] = null;
        $this->var['portion_size'] = null;
        $this->var['presentation'] = null;
        $this->var['uniqueness'] = null;

        $this->update['id'] = false;
        $this->update['dish_id'] = false;
        $this->update['user_id'] = false;
        $this->update['item_value'] = false;
        $this->update['portion_size'] = false;
        $this->update['presentation'] = false;
        $this->update['uniqueness'] = false;
    }

    public function getId() {
        return $this->var['id'];
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

    public function setUserId($user_id) {
        if ($this->var['user_id'] != $user_id) {
            $this->var['user_id'] = $user_id;
            $this->update['user_id'] = true;
        }
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setItemValue($item_value) {
        if ($this->var['item_value'] != $item_value) {
            $this->var['item_value'] = $item_value;
            $this->update['item_value'] = true;
        }
    }
    public function getItemValue() {
        return $this->var['item_value'];
    }

    public function setPortionSize($portion_size) {
        if ($this->var['portion_size'] != $portion_size) {
            $this->var['portion_size'] = $portion_size;
            $this->update['portion_size'] = true;
        }
    }
    public function getPortionSize() {
        return $this->var['portion_size'];
    }

    public function setPresentation($presentation) {
        if ($this->var['presentation'] != $presentation) {
            $this->var['presentation'] = $presentation;
            $this->update['presentation'] = true;
        }
    }
    public function getPresentation() {
        return $this->var['presentation'];
    }

    public function setUniqueness($uniqueness) {
        if ($this->var['uniqueness'] != $uniqueness) {
            $this->var['uniqueness'] = $uniqueness;
            $this->update['uniqueness'] = true;
        }
    }
    public function getUniqueness() {
        return $this->var['uniqueness'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}