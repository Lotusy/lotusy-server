<?php
abstract class ReplyDaoGenerated extends LotusyDaoParent {

    protected static $table = 'reply';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['comment_id'] = null;
        $this->var['user_id'] = null;
        $this->var['nickname'] = null;
        $this->var['message'] = null;
        $this->var['create_time'] = null;

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

    public function setCommentId($comment_id) {
        if ($this->var['comment_id'] !== $comment_id) {
            $this->var['comment_id'] = $comment_id;
            $this->update['comment_id'] = true;
        }
    }
    public function getCommentId() {
        return $this->var['comment_id'];
    }

    public function setUserId($user_id) {
        if ($this->var['user_id'] !== $user_id) {
            $this->var['user_id'] = $user_id;
            $this->update['user_id'] = true;
        }
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setNickname($nickname) {
        if ($this->var['nickname'] !== $nickname) {
            $this->var['nickname'] = $nickname;
            $this->update['nickname'] = true;
        }
    }
    public function getNickname() {
        return $this->var['nickname'];
    }

    public function setMessage($message) {
        if ($this->var['message'] !== $message) {
            $this->var['message'] = $message;
            $this->update['message'] = true;
        }
    }
    public function getMessage() {
        return $this->var['message'];
    }

    public function setCreateTime($create_time) {
        if ($this->var['create_time'] !== $create_time) {
            $this->var['create_time'] = $create_time;
            $this->update['create_time'] = true;
        }
    }
    public function getCreateTime() {
        return $this->var['create_time'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}