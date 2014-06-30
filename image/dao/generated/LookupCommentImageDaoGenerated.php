<?php
abstract class LookupCommentImageDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['image_id'] = '';
        $this->var['comment_id'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['image_id'] = false;
        $this->update['comment_id'] = false;
        $this->update['create_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setImageId($imageId) {
        $this->var['image_id'] = $imageId;
        $this->update['image_id'] = true;
    }
    public function getImageId() {
        return $this->var['image_id'];
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
        return 'lookup_comment_image';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_imag_lookup_image';
    }
}
?>