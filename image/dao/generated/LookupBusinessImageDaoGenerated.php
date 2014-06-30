<?php
abstract class LookupBusinessImageDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['image_id'] = '';
        $this->var['business_id'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['image_id'] = false;
        $this->update['business_id'] = false;
        $this->update['create_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setImageId($imageId) {
        $this->var['image_id'] = $imageId;
        $this->update['image_id'] = true;
    }
    public function getImageId() {
        return $this->var['image_id'];
    }

    public function setBusinessId($businessId) {
        $this->var['business_id'] = $businessId;
        $this->update['business_id'] = true;
    }
    public function getBusinessId() {
        return $this->var['business_id'];
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
        return 'lookup_business_image';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_imag_lookup_image';
    }
}
?>