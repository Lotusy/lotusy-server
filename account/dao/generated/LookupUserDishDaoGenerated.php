<?php
abstract class LookupUserDishDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['user_id'] = '';
        $this->var['dish_id'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['dish_id'] = false;
        $this->update['create_time'] = false;
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

    public function setCreateTime($createTime) {
        $this->var['create_time'] = $createTime;
        $this->update['create_time'] = true;
    }
    public function getCreateTime() {
        return $this->var['create_time'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'lookup_user_dish';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_acct_lookup_user';
    }
}
?>