<?php
abstract class UserAlertDaoGenerated extends LotusyDaoParent {

    protected static $table = 'user_alert';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['keyword_code'] = null;
        $this->var['user_id'] = null;

        $this->update['id'] = false;
        $this->update['keyword_code'] = false;
        $this->update['user_id'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setKeywordCode($keyword_code) {
        if ($this->var['keyword_code'] !== $keyword_code) {
            $this->var['keyword_code'] = $keyword_code;
            $this->update['keyword_code'] = true;
        }
    }
    public function getKeywordCode() {
        return $this->var['keyword_code'];
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

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}