<?php
abstract class LookupBusinessZhNameDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['zh_name'] = '';
        $this->var['business_id'] = '';

        $this->update['id'] = false;
        $this->update['zh_name'] = false;
        $this->update['business_id'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setZhName($zhName) {
        $this->var['zh_name'] = $zhName;
        $this->update['zh_name'] = true;
    }
    public function getZhName() {
        return $this->var['zh_name'];
    }

    public function setBusinessId($businessId) {
        $this->var['business_id'] = $businessId;
        $this->update['business_id'] = true;
    }
    public function getBusinessId() {
        return $this->var['business_id'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'lookup_business_zh_name';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_busi_lookup_business';
    }
}
?>