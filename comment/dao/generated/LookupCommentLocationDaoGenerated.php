<?php
abstract class LookupCommentLocationDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['lat'] = '';
        $this->var['lng'] = '';
        $this->var['comment_id'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['lat'] = false;
        $this->update['lng'] = false;
        $this->update['comment_id'] = false;
        $this->update['create_time'] = false;
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

    public function setCommentId($commentId) {
        $this->var['comment_id'] = $commentId;
        $this->update['comment_id'] = true;
    }
    public function getCommentId() {
        return $this->var['comment_id'];
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
        return 'lookup_comment_location';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_comm_lookup_comment';
    }
}
?>