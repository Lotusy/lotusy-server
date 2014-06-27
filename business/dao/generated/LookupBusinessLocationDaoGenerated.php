<?php
abstract class LookupBusinessLocationDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['lat'] = '';
        $this->var['lng'] = '';
        $this->var['business_id'] = '';
        $this->var['verified'] = '';

        $this->update['id'] = false;
        $this->update['lat'] = false;
        $this->update['lng'] = false;
        $this->update['business_id'] = false;
        $this->update['verified'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setLat($lat) {
        $this->var['lat'] = $lat;
        $this->update['lat'] = true;
    }
    public function getLat() {
        return $this->var['lat'];
    }

    public function setLng($lng) {
        $this->var['lng'] = $lng;
        $this->update['lng'] = true;
    }
    public function getLng() {
        return $this->var['lng'];
    }

    public function setBusinessId($businessId) {
        $this->var['business_id'] = $businessId;
        $this->update['business_id'] = true;
    }
    public function getBusinessId() {
        return $this->var['business_id'];
    }

    public function setVerified($verified) {
        $this->var['verified'] = $verified;
        $this->update['verified'] = true;
    }
    public function getVerified() {
        return $this->var['verified'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'lookup_business_location';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_busi_lookup_business';
    }
}
?>