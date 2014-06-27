<?php
abstract class LookupBusinessTwNameDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['tw_name'] = '';
        $this->var['business_id'] = '';

        $this->update['id'] = false;
        $this->update['tw_name'] = false;
        $this->update['business_id'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setTwName($twName) {
        $this->var['tw_name'] = $twName;
        $this->update['tw_name'] = true;
    }
    public function getTwName() {
        return $this->var['tw_name'];
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
        return 'lookup_business_tw_name';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_busi_lookup_business';
    }
}
?>