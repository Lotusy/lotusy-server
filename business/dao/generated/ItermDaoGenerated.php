<?php
abstract class ItermDaoGenerated extends LotusyDaoParent {

    protected static $table = 'iterm';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['code'] = null;
        $this->var['type'] = null;
        $this->var['language'] = null;
        $this->var['description'] = null;
        $this->var['active'] = null;
        $this->var['admin_create'] = null;
        $this->var['last_modify'] = null;
        $this->var['ctime'] = null;
        $this->var['mtime'] = null;

        $this->update['id'] = false;
        $this->update['code'] = false;
        $this->update['type'] = false;
        $this->update['language'] = false;
        $this->update['description'] = false;
        $this->update['active'] = false;
        $this->update['admin_create'] = false;
        $this->update['last_modify'] = false;
        $this->update['ctime'] = false;
        $this->update['mtime'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setCode($code) {
        if ($this->var['code'] != $code) {
            $this->var['code'] = $code;
            $this->update['code'] = true;
        }
    }
    public function getCode() {
        return $this->var['code'];
    }

    public function setType($type) {
        if ($this->var['type'] != $type) {
            $this->var['type'] = $type;
            $this->update['type'] = true;
        }
    }
    public function getType() {
        return $this->var['type'];
    }

    public function setLanguage($language) {
        if ($this->var['language'] != $language) {
            $this->var['language'] = $language;
            $this->update['language'] = true;
        }
    }
    public function getLanguage() {
        return $this->var['language'];
    }

    public function setDescription($description) {
        if ($this->var['description'] != $description) {
            $this->var['description'] = $description;
            $this->update['description'] = true;
        }
    }
    public function getDescription() {
        return $this->var['description'];
    }

    public function setActive($active) {
        if ($this->var['active'] != $active) {
            $this->var['active'] = $active;
            $this->update['active'] = true;
        }
    }
    public function getActive() {
        return $this->var['active'];
    }

    public function setAdminCreate($admin_create) {
        if ($this->var['admin_create'] != $admin_create) {
            $this->var['admin_create'] = $admin_create;
            $this->update['admin_create'] = true;
        }
    }
    public function getAdminCreate() {
        return $this->var['admin_create'];
    }

    public function setLastModify($last_modify) {
        if ($this->var['last_modify'] != $last_modify) {
            $this->var['last_modify'] = $last_modify;
            $this->update['last_modify'] = true;
        }
    }
    public function getLastModify() {
        return $this->var['last_modify'];
    }

    public function setCtime($ctime) {
        if ($this->var['ctime'] != $ctime) {
            $this->var['ctime'] = $ctime;
            $this->update['ctime'] = true;
        }
    }
    public function getCtime() {
        return $this->var['ctime'];
    }

    public function setMtime($mtime) {
        if ($this->var['mtime'] != $mtime) {
            $this->var['mtime'] = $mtime;
            $this->update['mtime'] = true;
        }
    }
    public function getMtime() {
        return $this->var['mtime'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}