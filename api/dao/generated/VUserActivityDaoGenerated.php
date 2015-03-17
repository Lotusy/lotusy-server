<?php
abstract class VUserActivityDaoGenerated extends LotusyDaoParent {

    protected static $table = 'v_user_activity';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['user_id'] = null;
        $this->var['other_id'] = null;
        $this->var['type'] = null;
        $this->var['data'] = null;
        $this->var['create_time'] = null;

        $this->update['user_id'] = false;
        $this->update['other_id'] = false;
        $this->update['type'] = false;
        $this->update['data'] = false;
        $this->update['create_time'] = false;
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

    public function setOtherId($other_id) {
        if ($this->var['other_id'] !== $other_id) {
            $this->var['other_id'] = $other_id;
            $this->update['other_id'] = true;
        }
    }
    public function getOtherId() {
        return $this->var['other_id'];
    }

    public function setType($type) {
        if ($this->var['type'] !== $type) {
            $this->var['type'] = $type;
            $this->update['type'] = true;
        }
    }
    public function getType() {
        return $this->var['type'];
    }

    public function setData($data) {
        if ($this->var['data'] !== $data) {
            $this->var['data'] = $data;
            $this->update['data'] = true;
        }
    }
    public function getData() {
        return $this->var['data'];
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
        return '';
    }
}