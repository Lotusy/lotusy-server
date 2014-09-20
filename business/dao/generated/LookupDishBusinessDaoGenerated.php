<?php
abstract class LookupDishBusinessDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['business_id'] = '';
        $this->var['dish_id'] = '';

        $this->update['id'] = false;
        $this->update['business_id'] = false;
        $this->update['dish_id'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setBusinessId($businessId) {
        $this->var['business_id'] = $businessId;
        $this->update['business_id'] = true;
    }
    public function getBusinessId() {
        return $this->var['business_id'];
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
        return 'lookup_dish_business';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_busi_lookup_dish';
    }
}
?>