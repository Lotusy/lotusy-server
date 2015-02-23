<?php
abstract class ClientDaoGenerated extends LotusyDaoParent {

    protected static $table = 'client';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['app_key'] = null;
        $this->var['name'] = null;
        $this->var['scope'] = null;
        $this->var['create_time'] = null;
        $this->var['modified_time'] = null;

        $this->update['id'] = false;
        $this->update['app_key'] = false;
        $this->update['name'] = false;
        $this->update['scope'] = false;
        $this->update['create_time'] = false;
        $this->update['modified_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setAppKey($app_key) {
        if ($this->var['app_key'] !== $app_key) {
            $this->var['app_key'] = $app_key;
            $this->update['app_key'] = true;
        }
    }
    public function getAppKey() {
        return $this->var['app_key'];
    }

    public function setName($name) {
        if ($this->var['name'] !== $name) {
            $this->var['name'] = $name;
            $this->update['name'] = true;
        }
    }
    public function getName() {
        return $this->var['name'];
    }

    public function setScope($scope) {
        if ($this->var['scope'] !== $scope) {
            $this->var['scope'] = $scope;
            $this->update['scope'] = true;
        }
    }
    public function getScope() {
        return $this->var['scope'];
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

    public function setModifiedTime($modified_time) {
        if ($this->var['modified_time'] !== $modified_time) {
            $this->var['modified_time'] = $modified_time;
            $this->update['modified_time'] = true;
        }
    }
    public function getModifiedTime() {
        return $this->var['modified_time'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}