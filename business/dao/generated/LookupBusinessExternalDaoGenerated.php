<?php
abstract class LookupBusinessExternalDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['business_id'] = '';
        $this->var['external_id'] = '';
        $this->var['external_type'] = '';

        $this->update['id'] = false;
        $this->update['business_id'] = false;
        $this->update['external_id'] = false;
        $this->update['external_type'] = false;
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

    public function setExternalId($externalId) {
        $this->var['external_id'] = $externalId;
        $this->update['external_id'] = true;
    }
    public function getExternalId() {
        return $this->var['external_id'];
    }

    public function setExternalType($externalType) {
        $this->var['external_type'] = $externalType;
        $this->update['external_type'] = true;
    }
    public function getExternalType() {
        return $this->var['external_type'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'lookup_business_external';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_busi_lookup_business';
    }
}
?>