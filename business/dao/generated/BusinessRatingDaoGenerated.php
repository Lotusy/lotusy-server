<?php
abstract class BusinessRatingDaoGenerated extends LotusyDaoParent {

    protected static $table = 'business_rating';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['business_id'] = null;
        $this->var['user_id'] = null;
        $this->var['food'] = null;
        $this->var['serv'] = null;
        $this->var['env'] = null;
        $this->var['overall'] = null;
        $this->var['create_time'] = null;

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

    public function setBusinessId($business_id) {
        if ($this->var['business_id'] !== $business_id) {
            $this->var['business_id'] = $business_id;
            $this->update['business_id'] = true;
        }
    }
    public function getBusinessId() {
        return $this->var['business_id'];
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

    public function setFood($food) {
        if ($this->var['food'] !== $food) {
            $this->var['food'] = $food;
            $this->update['food'] = true;
        }
    }
    public function getFood() {
        return $this->var['food'];
    }

    public function setServ($serv) {
        if ($this->var['serv'] !== $serv) {
            $this->var['serv'] = $serv;
            $this->update['serv'] = true;
        }
    }
    public function getServ() {
        return $this->var['serv'];
    }

    public function setEnv($env) {
        if ($this->var['env'] !== $env) {
            $this->var['env'] = $env;
            $this->update['env'] = true;
        }
    }
    public function getEnv() {
        return $this->var['env'];
    }

    public function setOverall($overall) {
        if ($this->var['overall'] !== $overall) {
            $this->var['overall'] = $overall;
            $this->update['overall'] = true;
        }
    }
    public function getOverall() {
        return $this->var['overall'];
    }

    public function setCreateTime($create_time) {
        if ($this->var['create_time'] !== $create_time) {
            $this->var['create_time'] = $create_time;
            $this->update['create_time'] = true;
        }
    }
    public function getCreateTime() {
        return $this->var['create_time'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}