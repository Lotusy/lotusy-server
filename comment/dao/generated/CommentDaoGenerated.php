<?php
abstract class CommentDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['business_id'] = '';
        $this->var['user_id'] = '';
        $this->var['lat'] = '';
        $this->var['lng'] = '';
        $this->var['message'] = '';
        $this->var['like_count'] = '';
        $this->var['is_deleted'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['business_id'] = false;
        $this->update['user_id'] = false;
        $this->update['lat'] = false;
        $this->update['lng'] = false;
        $this->update['message'] = false;
        $this->update['like_count'] = false;
        $this->update['is_deleted'] = false;
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

    public function setUserId($userId) {
        $this->var['user_id'] = $userId;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
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

    public function setMessage($message) {
        $this->var['message'] = $message;
        $this->update['message'] = true;
    }
    public function getMessage() {
        return $this->var['message'];
    }

    public function setLikeCount($likeCount) {
        $this->var['like_count'] = $likeCount;
        $this->update['like_count'] = true;
    }
    public function getLikeCount() {
        return $this->var['like_count'];
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
        return 'comment';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_comm_comment';
    }
}
?>