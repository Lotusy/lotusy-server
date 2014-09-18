<?php
abstract class LookupCommentDishDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['dish_id'] = '';
        $this->var['comment_id'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['dish_id'] = false;
        $this->update['comment_id'] = false;
        $this->update['create_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setDishId($dishId) {
        $this->var['dish_id'] = $dishId;
        $this->update['dish_id'] = true;
    }
    public function getDishId() {
        return $this->var['dish_id'];
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
        return 'lookup_comment_dish';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_comm_lookup_comment';
    }
}
?>