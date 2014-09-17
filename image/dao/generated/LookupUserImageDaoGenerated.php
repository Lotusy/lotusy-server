<?php
abstract class LookupUserImageDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['fast_id'] = '';
        $this->var['user_id'] = '';
        $this->var['type'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['fast_id'] = false;
        $this->update['user_id'] = false;
        $this->update['type'] = false;
        $this->update['create_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setFastId($fastId) {
        $this->var['fast_id'] = $fastId;
        $this->update['fast_id'] = true;
    }
    public function getFastId() {
        return $this->var['fast_id'];
    }

    public function setUserId($userId) {
        $this->var['user_id'] = $userId;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setType($type) {
        $this->var['type'] = $type;
        $this->update['type'] = true;
    }
    public function getType() {
        return $this->var['type'];
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
        return 'lookup_user_image';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_imag_lookup_image';
    }
}
?>