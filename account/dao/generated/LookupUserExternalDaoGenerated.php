<?php
abstract class LookupUserExternalDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['type'] = '';
        $this->var['reference'] = '';
        $this->var['user_id'] = '';

        $this->update['id'] = false;
        $this->update['type'] = false;
        $this->update['reference'] = false;
        $this->update['user_id'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setType($type) {
        $this->var['type'] = $type;
        $this->update['type'] = true;
    }
    public function getType() {
        return $this->var['type'];
    }

    public function setReference($reference) {
        $this->var['reference'] = $reference;
        $this->update['reference'] = true;
    }
    public function getReference() {
        return $this->var['reference'];
    }

    public function setUserId($userId) {
        $this->var['user_id'] = $userId;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'lookup_user_external';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_acct_lookup_user';
    }
}
?>