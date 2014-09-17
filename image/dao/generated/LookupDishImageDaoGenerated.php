<?php
abstract class LookupDishImageDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['fast_id'] = '';
        $this->var['dish_id'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['fast_id'] = false;
        $this->update['dish_id'] = false;
        $this->update['create_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setFastId($fastId) {
        $this->var['fast_id'] = $fastId;
        $this->update['fast_id'] = true;
    }
    public function getFastId() {
        return $this->var['fast_id'];
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
        return 'lookup_dish_image';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_imag_lookup_image';
    }
}
?>