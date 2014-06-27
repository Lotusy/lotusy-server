<?php
abstract class RatingDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['business_id'] = '';
        $this->var['user_id'] = '';
        $this->var['food'] = '';
        $this->var['serv'] = '';
        $this->var['env'] = '';
        $this->var['overall'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['business_id'] = false;
        $this->update['user_id'] = false;
        $this->update['food'] = false;
        $this->update['serv'] = false;
        $this->update['env'] = false;
        $this->update['overall'] = false;
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

    public function setFood($food) {
        $this->var['food'] = $food;
        $this->update['food'] = true;
    }
    public function getFood() {
        return $this->var['food'];
    }

    public function setServ($serv) {
        $this->var['serv'] = $serv;
        $this->update['serv'] = true;
    }
    public function getServ() {
        return $this->var['serv'];
    }

    public function setEnv($env) {
        $this->var['env'] = $env;
        $this->update['env'] = true;
    }
    public function getEnv() {
        return $this->var['env'];
    }

    public function setOverall($overall) {
        $this->var['overall'] = $overall;
        $this->update['overall'] = true;
    }
    public function getOverall() {
        return $this->var['overall'];
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
        return 'rating';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_busi_business';
    }
}
?>