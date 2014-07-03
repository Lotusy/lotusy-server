<?php
abstract class ReplyDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['comment_id'] = '';
        $this->var['user_id'] = '';
        $this->var['nickname'] = '';
        $this->var['message'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['comment_id'] = false;
        $this->update['user_id'] = false;
        $this->update['nickname'] = false;
        $this->update['message'] = false;
        $this->update['create_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setCommentId($commentId) {
        $this->var['comment_id'] = $commentId;
        $this->update['comment_id'] = true;
    }
    public function getCommentId() {
        return $this->var['comment_id'];
    }

    public function setUserId($userId) {
        $this->var['user_id'] = $userId;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setNickname($nickname) {
        $this->var['nickname'] = $nickname;
        $this->update['nickname'] = true;
    }
    public function getNickname() {
        return $this->var['nickname'];
    }

    public function setMessage($message) {
        $this->var['message'] = $message;
        $this->update['message'] = true;
    }
    public function getMessage() {
        return $this->var['message'];
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
        return 'reply';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_comm_comment';
    }
}
?>