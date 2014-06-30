<?php
abstract class UserImageDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['user_id'] = '';
        $this->var['name'] = '';
        $this->var['path'] = '';
        $this->var['is_deleted'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['name'] = false;
        $this->update['path'] = false;
        $this->update['is_deleted'] = false;
        $this->update['create_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setUserId($userId) {
        $this->var['user_id'] = $userId;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
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

    public function setIsDeleted($isDeleted) {
        $this->var['is_deleted'] = $isDeleted;
        $this->update['is_deleted'] = true;
    }
    public function getIsDeleted() {
        return $this->var['is_deleted'];
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
        return 'user_image';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_imag_image';
    }
}
?>