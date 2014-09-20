<?php
abstract class DishCollectionDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['user_id'] = '';
        $this->var['dish_id'] = '';

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['dish_id'] = false;
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

// ======================================================================================== override

    public function getTableName() {
        return 'dish_collection';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_acct_user';
    }
}
?>