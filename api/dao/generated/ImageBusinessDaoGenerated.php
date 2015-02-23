<?php
abstract class ImageBusinessDaoGenerated extends LotusyDaoParent {

    protected static $table = 'image_business';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['business_id'] = null;
        $this->var['name'] = null;
        $this->var['path'] = null;
        $this->var['create_time'] = null;

        $this->update['id'] = false;
        $this->update['business_id'] = false;
        $this->update['name'] = false;
        $this->update['path'] = false;
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

    public function setName($name) {
        if ($this->var['name'] !== $name) {
            $this->var['name'] = $name;
            $this->update['name'] = true;
        }
    }
    public function getName() {
        return $this->var['name'];
    }

    public function setPath($path) {
        if ($this->var['path'] !== $path) {
            $this->var['path'] = $path;
            $this->update['path'] = true;
        }
    }
    public function getPath() {
        return $this->var['path'];
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