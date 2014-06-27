<?php
abstract class LookupBusinessEnNameDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['en_name'] = '';
        $this->var['business_id'] = '';

        $this->update['id'] = false;
        $this->update['en_name'] = false;
        $this->update['business_id'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setEnName($enName) {
        $this->var['en_name'] = $enName;
        $this->update['en_name'] = true;
    }
    public function getEnName() {
        return $this->var['en_name'];
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
        return 'lookup_business_en_name';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_busi_lookup_business';
    }
}
?>