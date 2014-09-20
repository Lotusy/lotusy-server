<?php
abstract class DishDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['business_id'] = '';
        $this->var['user_id'] = '';
        $this->var['name_zh'] = '';
        $this->var['name_tw'] = '';
        $this->var['name_en'] = '';
        $this->var['verified'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['business_id'] = false;
        $this->update['user_id'] = false;
        $this->update['name_zh'] = false;
        $this->update['name_tw'] = false;
        $this->update['name_en'] = false;
        $this->update['verified'] = false;
        $this->update['create_time'] = false;
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

    public function setUserId($userId) {
        $this->var['user_id'] = $userId;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setNameZh($nameZh) {
        $this->var['name_zh'] = $nameZh;
        $this->update['name_zh'] = true;
    }
    public function getNameZh() {
        return $this->var['name_zh'];
    }

    public function setNameTw($nameTw) {
        $this->var['name_tw'] = $nameTw;
        $this->update['name_tw'] = true;
    }
    public function getNameTw() {
        return $this->var['name_tw'];
    }

    public function setNameEn($nameEn) {
        $this->var['name_en'] = $nameEn;
        $this->update['name_en'] = true;
    }
    public function getNameEn() {
        return $this->var['name_en'];
    }

    public function setVerified($verified) {
        $this->var['verified'] = $verified;
        $this->update['verified'] = true;
    }
    public function getVerified() {
        return $this->var['verified'];
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
        return 'dish';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_busi_dish';
    }
}
?>