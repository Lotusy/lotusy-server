<?php
abstract class LookupDishLikeUserDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['user_id'] = '';
        $this->var['dish_id'] = '';
        $this->var['is_like'] = '';

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['dish_id'] = false;
        $this->update['is_like'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setUserId($userId) {
        $this->var['user_id'] = $userId;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setDishId($dishId) {
        $this->var['dish_id'] = $dishId;
        $this->update['dish_id'] = true;
    }
    public function getDishId() {
        return $this->var['dish_id'];
    }

    public function setIsLike($isLike) {
        $this->var['is_like'] = $isLike;
        $this->update['is_like'] = true;
    }
    public function getIsLike() {
        return $this->var['is_like'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'lookup_dish_like_user';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_busi_lookup_dish';
    }
}
?>