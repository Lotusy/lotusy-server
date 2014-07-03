<?php
abstract class BusinessImageDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['business_id'] = '';
        $this->var['name'] = '';
        $this->var['path'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['business_id'] = false;
        $this->update['name'] = false;
        $this->update['path'] = false;
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

    public function setName($name) {
        $this->var['name'] = $name;
        $this->update['name'] = true;
    }
    public function getName() {
        return $this->var['name'];
    }

    public function setPath($path) {
        $this->var['path'] = $path;
        $this->update['path'] = true;
    }
    public function getPath() {
        return $this->var['path'];
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
        return 'business_image';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_imag_image';
    }
}
?>